<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Entity\Concert;
use App\Entity\User;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250303141806 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->createConcertTable($schema);
        $this->createConcertForeignKeys($schema);
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable(Concert::TABLE_NAME);
    }

    private function createConcertTable(Schema $schema): void
    {
        $table = $schema->createTable(Concert::TABLE_NAME);
        $table->addColumn('id', Types::INTEGER, ['autoincrement' => true]);
        $table->addColumn('name', Types::STRING, ['notnull' => true, 'length' => 255]);
        $table->addColumn('description', Types::TEXT, ['notnull' => true]);
        $table->addColumn('artist_id', Types::INTEGER, ['notnull' => false]);
        $table->setPrimaryKey(['id']);
    }

    private function createConcertForeignKeys(Schema $schema): void
    {
        $table = $schema->getTable(Concert::TABLE_NAME);

        $table->addForeignKeyConstraint(
            $schema->getTable(User::TABLE_NAME),
            ['artist_id'],
            ['id'],
            ['onDelete' => 'CASCADE'],
            'fk_app_concert_artist_id'
        );
    }
}
