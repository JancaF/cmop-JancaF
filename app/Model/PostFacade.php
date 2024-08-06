<?php
namespace App\Model;

use Nette;

final class PostFacade
{
    private $userFacade;

    public function __construct(
        private Nette\Database\Explorer $database,
        UserFacade $userFacade
        ) {
            $this->userFacade = $userFacade;
        }
        
	public function getPublicArticles()
	{
		return $this->database
			->table('posts')
			->where('created_at < ', new \DateTime)
			->order('created_at DESC');
	}
	public function getPublishedArticlesCount(): int
	{
		return $this->database->fetchField('SELECT COUNT(*) FROM posts WHERE created_at < ?', new \DateTime);
	}
    public function insertComment(int $postId, int $userId, string $content)
    {

    $user = $this->userFacade->getUserById($userId);


    if (!$user) {
        throw new \Exception('User not found');
    }

    $this->database->table('comments')->insert([
        'post_id' => $postId,
        'user_id' => $userId,
        'name' => $user->username,
        'email' => $user->email,
        'content' => $content,
    ]);

    }
    public function getComments(int $postId)
    {
        return $this->database
            ->table('comments')
            ->where('post_id', $postId)
            ->order('created_at');
    }
	public function getCommentById(int $id)
    {
        return $this->database
            ->table('comments')
            ->get($id);
    }
	
	public function getAllComments()
    {
        return $this->database
            ->table('comments')
            ->order('created_at');
    }
	public function getPostbyId($postId) {
		return $this->database->table('posts')->get($postId);
	}
	public function editPost(int $postId, array $data) {
		 $post = $this->database
			->table('posts')
			->get($postId);
		$post->update($data);
	}
	public function insertPost(array $data) {
		$this->database->table('posts')->insert($data);
	}
    public function addView(int $postId)
    {
        $post = $this->database
            ->table('posts')
            ->get($postId);

        $views = $post['views'] + 1;
    
        return $this->database
            ->table('posts')
            ->where('id', $postId)
            ->update(['views' => $views]);
    }
    public function deletePost(int $postId): bool
    {
    try {
        $post = $this->database
            ->table('posts')
            ->get($postId);

        if (!$post) {
            return false;
        }

        $this->deleteCommentsForPost($postId);

        $post->delete();

        return true;
    } catch (\Exception $e) {
        return false;
    }
    }
    public function deleteCommentsForPost(int $postId): void
    { 
    $this->database
        ->table('comments')
        ->where('post_id', $postId)
        ->delete();
    }
}

