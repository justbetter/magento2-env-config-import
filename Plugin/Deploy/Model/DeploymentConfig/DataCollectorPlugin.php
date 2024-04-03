<?php

namespace JustBetter\EnvConfigImport\Plugin\Deploy\Model\DeploymentConfig;

use JustBetter\EnvConfigImport\Plugin\BasePlugin;
use Magento\Deploy\Model\DeploymentConfig\DataCollector;

class DataCollectorPlugin extends BasePlugin
{

    public function afterGetConfig(DataCollector $subject, array $result, string|null $sectionName = null): array
    {
        if ($sectionName === null || $sectionName === "system") {
            $envConfiguration = $this->getConfigFromEnv($result['system'] ?? []);
            $result['system'] = $envConfiguration;
        }
        return $result;
    }

}
