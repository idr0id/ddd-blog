<?php

namespace Blog\InfrastructureBundle\ORM\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;

class DoctrineHelper
{
	/**
	 * @param ObjectManager|EntityManager $manager
	 * @param $class
	 * @return bool
	 */
	public static function truncate(ObjectManager $manager, $class)
	{
		/** @var $connection \Doctrine\DBAL\Connection */
		$connection = $manager->getConnection();
		/** @var $cmd ClassMetadata */
		$cmd = $manager->getClassMetadata($class);

		$connection->beginTransaction();
		try {
			if ($connection->getDatabasePlatform()->getName() !== 'sqlite') {
				$connection->query('SET FOREIGN_KEY_CHECKS=0');
				$connection->executeUpdate($connection->getDatabasePlatform()->getTruncateTableSql($cmd->getTableName()));
				$connection->query('SET FOREIGN_KEY_CHECKS=1');
			} else {
				$connection->executeUpdate(
					$connection->getDatabasePlatform()->getTruncateTableSql($cmd->getTableName())
				);
			}

			$connection->commit();
			return true;
		} catch (\Exception $e) {
			$connection->rollback();
			return false;
		}
	}
}
