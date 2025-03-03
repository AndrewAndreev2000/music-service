<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Entity\Album;
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
        $this->createAlbumTable($schema);

        $this->createAlbumForeignKeys($schema);
    }

    private function createAlbumTable(Schema $schema): void
    {
        $table = $schema->createTable(Album::TABLE_NAME);
        $table->addColumn('id', Types::INTEGER, ['autoincrement' => true]);
        $table->addColumn('name', Types::STRING, ['notnull' => true, 'length' => 255]);
        $table->addColumn('description', Types::TEXT, ['notnull' => true]);
        $table->addColumn('artist_id', Types::INTEGER, ['notnull' => false]);
        $table->setPrimaryKey(['id']);
    }

    private function createAlbumForeignKeys(Schema $schema): void
    {
        $table = $schema->getTable(Album::TABLE_NAME);

        $table->addForeignKeyConstraint(
            $schema->getTable(User::TABLE_NAME),
            ['artist_id'],
            ['id'],
            ['onDelete' => 'CASCADE'],
            'fk_app_album_artist_id'
        );
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable(Album::TABLE_NAME);
    }
}
