<?php

 namespace App\Http\Middleware;

 use Closure;
 use Illuminate\Http\Request;
 use Symfony\Component\HttpFoundation\Response;

 class IsAdminMiddleware
 {
     public function handle(Request $request, Closure $next): Response
     {
         // Cek: Apakah pengguna sudah login DAN apakah dia seorang admin?
         if (auth()->check() && auth()->user()->is_admin) {
             // Jika ya, izinkan masuk.
             return $next($request);
         }

         // Jika tidak, tendang ke halaman utama.
         return redirect('/');
     }
 }