<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AjaxRequest implements FilterInterface
{
   public function before(RequestInterface $request, $arguments = null)
   {
      if (!$this->isAjaxRequest($request)) {
         // Rediriger vers une page d'erreur ou renvoyer une réponse JSON appropriée
         return redirect()->to('/error');
      }
   }

   public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
   {
      // Ne rien faire après la demande AJAX
   }

   private function isAjaxRequest(RequestInterface $request)
   {
      // Vérifie si l'en-tête HTTP X-Requested-With est défini à XMLHttpRequest
      return strtolower($request->getHeaderLine('X-Requested-With')) === 'xmlhttprequest';
   }
}
