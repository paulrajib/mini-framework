<?php

namespace App\Libs;

use Doctrine\ORM\Tools\EntityGenerator as CoreEntityGenerator;
use Doctrine\ORM\Mapping\ClassMetadataInfo;

class EntityGenerator extends CoreEntityGenerator {
  /**
   * Generates and writes entity class to disk for the given ClassMetadataInfo instance.
   *
   * @param ClassMetadataInfo $metadata
   * @param string            $outputDirectory
   *
   * @return void
   *
   * @throws \RuntimeException
   */
  public function writeEntityClass(ClassMetadataInfo $metadata, $outputDirectory)
  {
      $folderMetadataNameParts = explode('\\', $metadata->name);
      $folderMetadataName = $folderMetadataNameParts[count($folderMetadataNameParts) - 1];
      $path = $outputDirectory . '/' . str_replace('\\', DIRECTORY_SEPARATOR, $folderMetadataName) . $this->extension;
      $dir = dirname($path);

      if ( ! is_dir($dir)) {
          mkdir($dir, 0775, true);
      }

      $this->isNew = !file_exists($path) || (file_exists($path) && $this->regenerateEntityIfExists);

      if ( ! $this->isNew) {
          $this->parseTokensInEntityFile(file_get_contents($path));
      } else {
          $this->staticReflection[$metadata->name] = array('properties' => array(), 'methods' => array());
      }

      if ($this->backupExisting && file_exists($path)) {
          $backupPath = dirname($path) . DIRECTORY_SEPARATOR . basename($path) . "~";
          if (!copy($path, $backupPath)) {
              throw new \RuntimeException("Attempt to backup overwritten entity file but copy operation failed.");
          }
      }

      // If entity doesn't exist or we're re-generating the entities entirely
      if ($this->isNew) {
          file_put_contents($path, $this->generateEntityClass($metadata));
      // If entity exists and we're allowed to update the entity class
      } elseif ( ! $this->isNew && $this->updateEntityIfExists) {
          file_put_contents($path, $this->generateUpdatedEntityClass($metadata, $path));
      }
      chmod($path, 0664);
  }
}

?>
