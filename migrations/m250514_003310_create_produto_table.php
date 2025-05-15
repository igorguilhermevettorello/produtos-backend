<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%produto}}`.
 */
class m250514_003310_create_produto_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%produto}}', [
            'id' => $this->string(36)->notNull()->unique(),
            'nome' => $this->string()->notNull(),
            'quantidade' => $this->integer()->notNull(),
            'categoria' => $this->integer()->notNull(),
        ]);
        $this->addPrimaryKey('pk_produto_id', '{{%produto}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%produto}}');
    }
}
