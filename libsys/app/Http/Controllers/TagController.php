<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Facades\Response;

class TagController extends Controller
{
    public function generateTag(string $id = null)
    {
        $zpl = $this->getTag(unserialize($id));

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, "http://api.labelary.com/v1/printers/8dpmm/labels/4x2/0/");
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $zpl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Accept: application/pdf"));

        $result = curl_exec($curl);

        if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
            $response = Response::make($result, 200);
            $response->header('Content-Type', 'application/pdf');
            $response->header('Content-Disposition', 'attachment; filename=etiqueta.pdf');
            return $response;
        }

        return "Error: $result";
    }

    private function getTag(int $id = null)
    {
        $books = (new Book())->lstBook(!empty($id) ? $id : null);

        $zplCode = '^XA^CI28';
        foreach ($books as $book) {
            $zplCode .= "^ASN,20,10^FO60,20^FDAcervo: " . $book['idBookCopie'] . "^FS";
            $zplCode .= "^ASN,20,10^FO450,20^FDISBN: " . $book['ISBN'] . "^FS";

            $zplCode .= "^ASN,20,10^FO60,60^FDTítulo: " . $book['title'] . "^FS";

            $zplCode .= "^ASN,20,10^FO60,100^FDAutor: " . $book['author'] . "^FS";

            $zplCode .= "^FO600,130^BQN,2,7^FDHM,N " . $book['idBookCopie'] . "^FS";

            $zplCode .= "^FO50,300^GB700,3,3^FS";
        }
        $zplCode .= "^XZ";

        return $zplCode;
    }
}
