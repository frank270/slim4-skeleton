<?php

namespace App\Domain\User\Repository;

use App\Factory\QueryFactory;
use DomainException;

/**
 * Repository.
 */
final class UserReaderRepository
{
    /**
     * @var QueryFactory The query factory
     */
    private $queryFactory;

    /**
     * The constructor.
     *
     * @param QueryFactory $queryFactory The query factory
     */
    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    /**
     * Get user by id.
     *
     * @param int $userId The user id
     *
     * @throws DomainException
     *
     * @return array<mixed> The user row
     */
    public function getUserById(int $userId): array
    {
        $query = $this->queryFactory->newSelect('users');
        $query->select(
            [
                'id',
                'username',
                'first_name',
                'last_name',
                'email',
                'user_role_id',
                'locale',
                'enabled',
            ]
        );

        $query->andWhere(['id' => $userId]);

        $row = $query->execute()->fetch('assoc');

        if (!$row) {
            throw new DomainException(sprintf('User not found: %s', $userId));
        }

        return $row;
    }
}
