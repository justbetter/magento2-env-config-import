<?php

namespace JustBetter\EnvConfigImport\Model\Config\Importer;

use Magento\Config\Model\Config\Importer as MagentoImporter;
use Magento\Config\Model\PreparedValueFactory;
use \Magento\Config\Model\ResourceModel\Config\Data;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Config\Value;
use Magento\Framework\Stdlib\ArrayUtils;

class CustomSaveProcessor extends \Magento\Config\Model\Config\Importer\SaveProcessor
{
    /**
     * Builder which creates value object according to their backend models.
     *
     * @var PreparedValueFactory
     */
    private $valueFactory;

    /**
     * An array utils.
     *
     * @var ArrayUtils
     */
    private $arrayUtils;

    /**
     * The application config storage.
     *
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * {@inheritDoc}
     */
    public function __construct(
        ArrayUtils $arrayUtils,
        PreparedValueFactory $valueBuilder,
        ScopeConfigInterface $scopeConfig,
        protected Data $resourceValue
    ) {
        $this->arrayUtils = $arrayUtils;
        $this->valueFactory = $valueBuilder;
        $this->scopeConfig = $scopeConfig;
        parent::__construct($arrayUtils, $valueBuilder, $scopeConfig);
    }

    /**
     * {@inheritDoc}
     */
    public function process(array $data)
    {
        foreach ($data as $scope => $scopeData) {
            if ($scope === ScopeConfigInterface::SCOPE_TYPE_DEFAULT) {
                $this->invokeSave($scopeData, $scope);
            } else {
                foreach ($scopeData as $scopeCode => $scopeCodeData) {
                    $this->invokeSave($scopeCodeData, $scope, $scopeCode);
                }
            }
        }
    }

    /**
     * {@inheritDoc}
     */
    public function invokeSave(array $scopeData, string $scope, ?string $scopeCode = null): void
    {
        $scopeData = array_keys($this->arrayUtils->flatten($scopeData));

        foreach ($scopeData as $path) {
            $value = $this->scopeConfig->getValue($path, $scope, $scopeCode);
            if ($value !== null) {
                $backendModel = $this->valueFactory->create($path, $value, $scope, $scopeCode);

                if ($backendModel instanceof Value) {
                    $this->resourceValue->save($backendModel);
                }
            }
        }
    }
}
