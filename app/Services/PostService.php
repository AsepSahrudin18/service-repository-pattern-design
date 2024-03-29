<?php

namespace App\Services;

// import post repository
use App\Repositories\PostRepository;
use InvalidArgumentException;


class PostService
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getAll()
    {
        return $this->postRepository->getAll();
    }


    public function store($data)
    {
        $validator = \Validator::make($data, [
            'title' => 'required',
            'description' => 'required'
        ]);

        if($validator->fails())
        {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $result = $this->postRepository->save($data);

        return $result;
    }
}