<?php
/**
 * Copyright © 2015 UIS. All rights reserved.
 */

namespace UIS\Sizecharts\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
	
        $installer = $setup;

        $installer->startSetup();

		/**
         * Create table 'sizecharts_sizecharts'
         */
        $table = $installer->getConnection()->newTable(
            $installer->getTable('sizecharts_sizecharts')
        )
		->addColumn(
            'id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
            'sizecharts_sizecharts'
        )
		->addColumn(
            'sizecharts_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['nullable' => false],
            'sizecharts_id'
        )
		->addColumn(
            'label',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '64k',
            [],
            'label'
        )
		->addColumn(
            'is_unisex',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '64k',
            [],
            'is_unisex'
        )
		/*{{CedAddTableColumn}}}*/
		
		
        ->setComment(
            'UIS Sizecharts sizecharts_sizecharts'
        );
		
		$installer->getConnection()->createTable($table);
		/*{{CedAddTable}}*/

        $installer->endSetup();

    }
}
