<?php

namespace App\Http\Controllers;

/*
Copyright 2019 Marya Doery
MIT License https://opensource.org/licenses/MIT
Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

/*
 * To run this project, make sure that the AWS PHP SDK has been unzipped in the current directory.
 * 
 * Caution: this is not production quality code. There are no tests, and there is no error handling.
 */

use Aws\Textract\TextractClient;
use Illuminate\Http\Request;

// If you use CredentialProvider, it will use credentials in your .aws/credentials file.
class AWSTextExtractorController extends Controller
{
    public function index(Request $request, $foldernumber)
    {
        /**

         * @get('/awstx/{id}')
         * @name('')
         * @middlewares(web, globalVariable)
         */

        $client = new TextractClient([
            'region' => 'ap-south-1',
            'version' => '2018-06-27',
            'credentials' => [
                'key'    => 'AKIA2CBSNPYWW5NC6JPK',
                'secret' => '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'
            ]
        ]);

        // $directory = "prescriptions/";
        // $foldercount = 0;
        // $folders = glob($directory . "*");
        // if ($folders) {
        //     $foldercount = count($folders) - 2;
        // }

        $i = $foldernumber;

        $file_list=[];
        // for ($i = 1; $i <= $foldercount; $i++) {
            $file_path = "prescriptions/" . $i . "/";
            $files = glob($file_path . "*.jpg");
            $file_list[$i]=$files;
        // }
        
        // If debugging:
        // $i = 1;
        foreach ($file_list as $filepath) {
            foreach ($filepath as $path) {
                echo "<pre>";
                // The file in this project.
                $filename = $path;
                $file = fopen($filename, "rb");
                $contents = fread($file, filesize($filename));
                fclose($file);

                // Textract Result
                $result = $client->detectDocumentText([
                    'Document' => [
                        'Bytes' => $contents, // REQUIRED
                    ],
                ]);

                $blocks = $result['Blocks'];
                // Loop through all the blocks:
                foreach ($blocks as $key => $value) {
                    if (!(isset($value['BlockType']) && $value['BlockType'])){
                continue;} 
                        $blockType = $value['BlockType'];
                        if (isset($value['Text']) && $value['Text']) {
                            $text = $value['Text'];
                            if ($blockType == 'WORD') {
                                $dataarray[] = "Word: " . $text;
                                // If Debugging
                                // echo "Word: " . print_r($text, true) . "\n";
                            } else if ($blockType == 'LINE') {
                                $dataarray2[] = "Line: " . $text;
                                // If Debugging
                                // echo "Line: " . print_r($text, true) . "\n";
                            }
                        }
                    
                }

                $json_string = implode("\n", $dataarray) . "\n" . implode("\n", $dataarray2);

                // Saving the file
                $file_handle = fopen($file_path . 'clean.txt', 'w');
                fwrite($file_handle, $json_string);
                fclose($file_handle);

                // If debugging:
                // echo $i;
                // echo print_r($result, true);
                // echo "<pre>";
                // $i++;
            }
            echo "File Saved Successfully in" . $file_path . "clean.txt";
        }
    }
}
