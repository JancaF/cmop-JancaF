<?php

declare(strict_types=1);

namespace App\Model;

use Nette;
use Nette\Security\Passwords;

final class UserFacade implements Nette\Security\Authenticator
{

	public const PasswordMinLength = 7;

	private const
		TableName = 'users',
		ColumnId = 'id',
		ColumnName = 'username',
		ColumnSurname = 'surname',
		ColumnLastname = 'lastname',
		ColumnPasswordHash = 'password',
		ColumnEmail = 'email',
		ColumnRole = 'role',
		ColumnCreateAt = 'created_at';

	public function __construct(
		private Nette\Database\Explorer $database,
		private Passwords $passwords,
	) {
		$this->database = $database;
	}


	public function authenticate(string $username, string $password): Nette\Security\SimpleIdentity
	{
		$row = $this->database->table(self::TableName)
			->where(self::ColumnName, $username)
			->fetch();

		if (!$row) {
			throw new Nette\Security\AuthenticationException('The username is incorrect.', self::IdentityNotFound);

		} elseif (!$this->passwords->verify($password, $row[self::ColumnPasswordHash])) {
			throw new Nette\Security\AuthenticationException('The password is incorrect.', self::InvalidCredential);

		} elseif ($this->passwords->needsRehash($row[self::ColumnPasswordHash])) {
			$row->update([
				self::ColumnPasswordHash => $this->passwords->hash($password),
			]);
		}

		$arr = $row->toArray();
		unset($arr[self::ColumnPasswordHash]);
		return new Nette\Security\SimpleIdentity($row[self::ColumnId], $row[self::ColumnRole], $arr);
	}


	public function add(string $username, string $surname, string $lastname, string $email, string $password): void
	{
		Nette\Utils\Validators::assert($email, 'email');

		try {
			$this->database->table(self::TableName)->insert([
				self::ColumnName => $username,
				self::ColumnSurname => $surname,
				self::ColumnLastname => $lastname,
				self::ColumnPasswordHash => $this->passwords->hash($password),
				self::ColumnEmail => $email,
				self::ColumnCreateAt => new \DateTime(),
			]);
		} catch (Nette\Database\UniqueConstraintViolationException $e) {
			throw new DuplicateNameException;
		}
	}

	
    public function getUserById(int $userId)
    {
        return $this->database
            ->table('users')
            ->get($userId);
    }


	public function getUsers()
	{
		return $this->database->table('users');
	}

	public function deleteUser(int $userId): bool
	{
    try {
        // Získáme uživatele podle ID
        $user = $this->database
            ->table('users')
            ->get($userId);

        // Pokud uživatel neexistuje, vrátíme false
        if (!$user) {
            return false;
        }

        // Smazání komentářů uživatele
        $this->deleteCommentsForUser($userId);

        // Získání příspěvků uživatele
        $posts = $this->database
            ->table('posts')
            ->where('user_id', $userId);

        // Procházíme všechny příspěvky uživatele a smažeme je
        foreach ($posts as $post) {
            // Smazání komentářů příspěvku
            $this->deleteCommentsForPost($post->id);
            // Smazání příspěvku
            $post->delete();
        }

        // Smazání uživatele
        $user->delete();

        return true;
    } catch (\Exception $e) {
        return false;
    }
	}

	public function deleteCommentsForUser(int $userId): void
	{ 
	$this->database
		->table('comments')
		->where('user_id', $userId)
		->delete();
	}

	public function deleteCommentsForPost(int $postId): void
    { 
    $this->database
        ->table('comments')
        ->where('post_id', $postId)
        ->delete();
    }



}


class DuplicateNameException extends \Exception
{
}
