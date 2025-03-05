<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Entity\Genre;
use App\Entity\User;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250302035127 extends AbstractMigration
{
    public const USER_GENRE_TABLE_NAME = 'app_user_genre';

    public function up(Schema $schema): void
    {
        /* Tables generation * */
        $this->createUserTable($schema);
        $this->createUserGenreTable($schema);

        /* Foreign keys generation * */
        $this->createUserGenreForeignKeys($schema);
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable(User::TABLE_NAME);
    }

    private function createUserTable(Schema $schema): void
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

    private function createUserGenreTable(Schema $schema): void
    {
        $table = $schema->createTable(self::USER_GENRE_TABLE_NAME);
        $table->addColumn('user_id', Types::INTEGER, ['notnull' => true]);
        $table->addColumn('genre_id', Types::INTEGER, ['notnull' => true]);
        $table->setPrimaryKey(['user_id', 'genre_id']);
    }

    private function createUserGenreForeignKeys(Schema $schema): void
    {
        $table = $schema->getTable(self::USER_GENRE_TABLE_NAME);
        $table->addForeignKeyConstraint(
            $schema->getTable(User::TABLE_NAME),
            ['user_id'],
            ['id'],
            ['onDelete' => 'CASCADE'],
            'fk_app_user_genre_user_id'
        );
        $table->addForeignKeyConstraint(
            $schema->getTable(Genre::TABLE_NAME),
            ['genre_id'],
            ['id'],
            ['onDelete' => 'CASCADE'],
            'fk_app_user_genre_genre_id'
        );
    }
}
