<?php

namespace JustBetter\EnvConfigImport\Plugin;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Base
{
    public function getConfigFromEnv(array $data): array
    {
        foreach ($_ENV as $path => $value) {
            if (str_starts_with($path, 'CONFIG')) {
                $configPath = explode('__', trim(strtolower($path), 'config__'));

                $newPath = [];
                $currentLevel =& $newPath;
                foreach ($configPath as $key => $configValue) {
                    $currentLevel[$configValue] = $value;
                    if ($key < count($configPath) - 1) {
                        $currentLevel[$configValue] = array();
                        $currentLevel =& $currentLevel[$configValue];
                    }
                }
                $data = array_merge_recursive($data, $newPath);
            }
        }
        return $data;
    }
}
