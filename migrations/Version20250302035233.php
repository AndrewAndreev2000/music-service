<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Entity\UserType;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250302035233 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $table = $schema->createTable(UserType::TABLE_NAME);
        $table->addColumn('id', Types::INTEGER, ['autoincrement' => true]);
        $table->addColumn('name', Types::STRING, ['notnull' => true, 'length' => 32]);
        $table->setPrimaryKey(['id']);
        $table->addUniqueIndex(['name'], 'UNIQ_USER_TYPE_NAME');
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable(UserType::TABLE_NAME);
    }
}
