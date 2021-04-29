<?php

class UserMapper
{
    /**
     * @var StorageAdapter
     */
    private $adapter;

    /**
     * @param StorageAdapter $strorage
     */
    public function __construct(StorageAdapter $strorage)
    {
        $this->adapter = $strorage;
    }

    /**
     * 根據id找到用戶,並返回一個物件
     */
    public function findByid(int $id): User
    {
        $result = $this->adapter->find($id);

        if (is_null($result)) {
            throw new InvalidArgumentException("User #$id not found");
        }

        return $this->mapRowToUser($result);
    }

    private function mapRowToUser(array $row): User
    {
        return User::fromState($row);
    }
}
