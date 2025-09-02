<x-app-layout>
     <div class="page-header">
         <h1>Admin Dashboard</h1>
     </div>

     <div class="py-12">
         <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
             <div class="page-content">
                 Selamat Datang di Dasbor Admin, {{ Auth::user()->name }}!
             </div>
         </div>
     </div>
 </x-app-layout>