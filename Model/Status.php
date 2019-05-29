<?php

namespace UIS\Sizecharts\Model;

class Status implements \Magento\Framework\Option\ArrayInterface
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;

	const STATUS_YES = 1;
    const STATUS_NO = 0;
    /**
     * get available statuses.
     *
     * @return []
     */
    public static function getAvailableStatuses()
    {
        return [
            self::STATUS_ENABLED => __('Enabled')
            , self::STATUS_DISABLED => __('Disabled'),
        ];
    }
	
	/**
     * get is unisex "Yes/No"
     *
     * @return []
     */
    public static function getGenderStatuses()
    {
        return [
            self::STATUS_NO => __('No')
            , self::STATUS_YES => __('Yes'),
        ];
    }
	
	/**
     * Retrieve options array.
     *
     * @return array
     */
    public function toOptionArray()
    {
        $result = [];

        foreach (self::getGenderStatuses() as $index => $value) {
            $result[] = ['value' => $index, 'label' => $value];
        }

        return $result;
    }

    /**
     * Retrieve option array
     *
     * @return string[]
     */
    public static function getOptionArray()
    {
        return self::getGenderStatuses();
    }

    /**
     * Retrieve option array with empty value
     *
     * @return string[]
     */
    public function getAllOptions()
    {
        $result = [];

        foreach (self::getGenderStatuses() as $index => $value) {
            $result[] = ['value' => $index, 'label' => $value];
        }

        return $result;
    }

    /**
     * Retrieve option text by option value
     *
     * @param string $optionId
     * @return string
     */
    public function getOptionText($optionId)
    {
        $options = self::getGenderStatuses();

        return isset($options[$optionId]) ? $options[$optionId] : null;
    }
	
	
	
}
