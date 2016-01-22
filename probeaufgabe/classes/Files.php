<?php

/**
 * Created by PhpStorm.
 * User: thomas.baur@gmail.com
 * Date: 20.01.2016
 * Time: 12:56
 */

include_once("config_db.php");

class Files {

	protected $pdo;

	/**
	 * get specific files of a user given by uid
	 * @param $uid
	 */
	public function getFiles($uid) {

		$uid =  $_SESSION['userid'];
		$this->pdo = config_db::getConnected();

		$statement = $this->pdo->prepare("SELECT * FROM files f
                                    INNER JOIN user_files uf ON (uf.fileid = f.id)
                                    INNER JOIN users u ON (uf.uid = u.id)
                                    WHERE uf.uid = :uid");
		$result = $statement->execute(array('uid' => $uid));
		$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        
		$fileinfo = array();
		foreach($rows as $row) {
	      $fileinfo[] = $row;
        }

		return $fileinfo;
	}


	/**
	 * creates a new file
	 * @param $filename
	 * @param $ftype
	 * @param $fsize
	 * @param $created
	 */
	public function newFile($filename, $ftype, $fsize, $created) {

		$this->pdo = config_db::getConnected();

		//new record in table files
		$statement = $this->pdo->prepare("INSERT INTO `files` (filename, ftype, filesize, created_at) VALUES (:filename, :ftype, :fsize, :created)");
		$result = $statement->execute(array('filename' => $filename, 'ftype' => $ftype, 'fsize' => $fsize, 'created' => $created));

		$userid = $_SESSION['userid'];
		$fileid = $this->pdo->lastInsertId();

		//new record in table user_files
		$stmt = $this->pdo->prepare("INSERT INTO `user_files` (uid, fileid) VALUES (:userid, :fileid)");
		$stmt->execute(array('userid' => $userid, 'fileid' => $fileid));

		
		if ($_FILES['upload']['name'] != "") {

		    // file uploaded, remove it
		    $moved = move_uploaded_file($_FILES['upload']['tmp_name'], config_db::FILEFOLDER .'/'. $_FILES['upload']['name']);
	    }

		if ($moved) {
			echo "Datei wurde verschoben";
		} else {
			echo "Datei konnte nicht verschoben werden";
		}


	}


	/**
	 * deletes a file
	 * @param $fileid
	 */
	public function deleteFile($fileid) {

		$this->pdo = config_db::getConnected();

		$filename = $this->getFileNameById($fileid);

		//delete this file
		$stmt = $this->pdo->prepare("DELETE FROM `files` WHERE id = :id");
		$stmt->bindParam(':id', $fileid);
		$stmt->execute();

		$stmt2 = $this->pdo->prepare("DELETE FROM `user_files` WHERE fileid = :fileid");
		$stmt2->bindParam(':fileid', $fileid);
		$stmt2->execute();

		//delete file if exists
		if (file_exists($filename)) {
			unlink(config_db::FILEFOLDER .'/'. $filename);
		}

	}

	/**
	 * gets filename by a given id
	 * @param $fileid
	 * @return mixed
	 */
	public function getFileNameById($fileid) {

		$this->pdo = config_db::getConnected();

		$stmt = $this->pdo->prepare("SELECT filename FROM `files` WHERE id = :id");
		$stmt->bindParam(':id', $fileid);
		$stmt->execute();

		$file = $stmt->fetch(PDO::FETCH_ASSOC);

		return $file['filename'];
	}


	/**
	 * renames a file
	 * @param $fileid
	 * @param $oldname
	 * @param $newName
	 */
	public function renameFile($fileid, $oldname, $newName) {

		$this->pdo = config_db::getConnected();

		$fileid = $_POST['fileid'];
		$oldname = $_POST['oldfile'];

		$query = "UPDATE `files` SET `filename` = :newFilename WHERE id = :id";
		$updatestmt = $this->pdo->prepare($query);
		$updatestmt->bindParam(':newFilename', $newName, PDO::PARAM_STR);
		$updatestmt->bindParam(':id', $fileid);
		$updatestmt->execute();

		//rename file
		//first set file-access
		chmod(config_db::FILEFOLDER .'/'. $oldname, 755);
		rename(config_db::FILEFOLDER .'/'. $oldname, config_db::FILEFOLDER .'/'. $newName);

	}
	
	/**
	 * formats filesize
	 * @param  size  filesize
	 * @return string
	 */
	function formatFilesize($size) {
        $arr_units = array(
            'Byte',
            'kB',
            'MB',
            'GB',
            'TB'
        );
        for ($i = 0; $size > 1024; $i++) {
            $size /= 1024;
        }
        return number_format($size, 2, ',', '').' '.$arr_units[$i];
    }

}