<?php


namespace App\Helpers\Files\Storage;

use Illuminate\Support\Facades\Storage;

class StorageDisk
{
	/**
	 * Get the default disk name
	 *
	 * @return \Illuminate\Config\Repository|mixed
	 */
	public static function getDiskName()
	{
		$defaultDisk = config('filesystems.default', 'public');
		// $defaultDisk = config('filesystems.cloud'); // Only for tests purpose!
		
		return $defaultDisk;
	}
	
	/**
	 * Get the default disk resources
	 *
	 * @return \Illuminate\Contracts\Filesystem\Filesystem
	 */
    public static function getDisk()
    {
		$defaultDisk = self::getDiskName();
		$disk = Storage::disk($defaultDisk);
		
		return $disk;
    }
	
	/**
	 * Set the backup system disks
	 */
    public static function setBackupDisks()
	{
		$disks = config('backup.backup.destination.disks');
		if (config('settings.backup.storage_disk') == '1') {
			$disks = [config('filesystems.cloud')];
		} else if (config('settings.backup.storage_disk') == '2') {
			$disks = array_merge($disks, [config('filesystems.cloud')]);
		}
		$disks = array_unique($disks);
		\Config::set('backup.backup.destination.disks', $disks);
	}
}
