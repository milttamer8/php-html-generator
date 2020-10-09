<?php
	//get indexhtml content
	ini_set('max_execution_time', 500);
	ini_set('memory_limit', '-1');
 	$htmlContent = file_get_contents($_FILES["indexFile"]["tmp_name"]);
 	$url = $_POST['out_url'];
 	$xmlContent = '';
 	$folderName = date('Y_m_d_H_i_s');
 	if (!is_dir('new/'.$folderName)) {
	  mkdir('new/'.$folderName);
	}
 	$xmlTemp = file_get_contents('xml/sitemaptemp.xml');
 	if (strpos($htmlContent, '|||') !== false && strpos($htmlContent, '§§§') !== false && strpos($htmlContent, '€€€') !== false) {

	    //get article file content
	    $totalArticle = count($_FILES['articleFile']['name']);
	    $totalImage = count($_FILES['imageFile']['name']);

	    for( $i=0 ; $i < $totalImage ; $i++ ) {
	    	$targetFile = "assets/img/".$_FILES["imageFile"]["name"][$i];
		 	move_uploaded_file($_FILES["imageFile"]["tmp_name"][$i], $targetFile);
	    }

	    for( $i=0 ; $i < $totalArticle ; $i++ ) {

			$articleContent = file_get_contents($_FILES["articleFile"]["tmp_name"][$i]);
		 	$fileName = $_FILES["articleFile"]["name"][$i];
		 	$fileNameHtml = str_replace(".html", '', $fileName);
		 	$saveFileName = str_replace(' ', '-', $_FILES["articleFile"]["name"][$i]);

		 	//Replace the title
		 	$htmlContentEdit = str_replace("|||", $fileNameHtml, $htmlContent);
		 	//Replace the image path
		 	$htmlContentEdit = str_replace("§§§", $_FILES["imageFile"]["name"][rand(0, $totalImage-1)], $htmlContentEdit);
		 	//Replace the text_scrib
			$htmlContentEdit = str_replace("€€€", $articleContent, $htmlContentEdit);
			$newFilePath = 'new/'.$folderName.'/'.$saveFileName;
			file_put_contents($newFilePath, $htmlContentEdit);
			$xmlContent .= '<url><loc> '.$url.'/'.$saveFileName.' </loc></url>' . PHP_EOL;
	    }
	    $xml = str_replace('xmlcontent', $xmlContent, $xmlTemp);
	    file_put_contents('new/'.$folderName.'/sitemap.xml', $xml);

	    //make the zip file
	    $pathdir = 'new/'.$folderName.'/';  
		// Enter the name to creating zipped directory 
		$zipcreated = 'new/'.$folderName.'/'.$folderName.'.zip';
		// Create new zip class 
		$zip = new ZipArchive;
		if($zip -> open($zipcreated, ZipArchive::CREATE ) === true) {
		    // Store the path into the variable 
		    $dir = opendir($pathdir);
		    while($file = readdir($dir)) {
		        if(is_file($pathdir.$file)) {
		            $zip -> addFile($pathdir.$file, $file);
		        }
		    }
		    $zip ->close();
		}
		
		//download file
		if (file_exists($zipcreated)) {
		    header('Content-Description: File Transfer');
		    header('Content-Type: application/octet-stream');
		    header('Content-Disposition: attachment; filename="'.basename($zipcreated).'"');
		    header('Expires: 0');
		    header('Cache-Control: must-revalidate');
		    header('Pragma: public');
		    header('Content-Length: ' . filesize($zipcreated));
		    readfile($zipcreated);
		}
		// session_start();
		// $_SESSION['success'] = "true";
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
	else {
		// session_start();
		// $_SESSION['error'] = "true";
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
 	
?>