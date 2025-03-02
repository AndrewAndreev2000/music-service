<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Entity\Genre;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250302034745 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $table = $schema->createTable(Genre::TABLE_NAME);
        $table->addColumn('id', Types::INTEGER, ['autoincrement' => true]);
        $table->addColumn('name', Types::STRING, ['notnull' => true, 'length' => 255]);
        $table->setPrimaryKey(['id']);
        $table->addUniqueIndex(['name'], 'UNIQ_GENRE_NAME');
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable(Genre::TABLE_NAME);
    }
}
