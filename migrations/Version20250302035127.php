<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Entity\User;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250302035127 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $table = $schema->createTable(User::TABLE_NAME);
        $table->addColumn('id', Types::INTEGER, ['autoincrement' => true]);
        $table->addColumn('email', Types::STRING, ['notnull' => true, 'length' => 255]);
        $table->addColumn('password', Types::STRING, ['notnull' => true, 'length' => 255]);
        $table->addColumn('roles', Types::JSON, ['notnull' => true]);
        $table->addColumn('name', Types::STRING, ['notnull' => true, 'length' => 255]);
        $table->setPrimaryKey(['id']);
        $table->addUniqueIndex(['email'], 'UNIQ_USER_EMAIL');
        $table->addUniqueIndex(['name'], 'UNIQ_USER_NAME');
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable(User::TABLE_NAME);
    }
}
