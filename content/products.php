<main role="main">
  <div class="album text-muted">
    <div class="container">

      <div class="row">

        <div class="col-sm-9 blog-main">
          <?php
           getProducts();
           ?>
       </div>
       <aside class="col-sm-3 ml-sm-auto blog-sidebar">
         <div class="sidebar-module">
           <h5>RECENT</h5>
           <ol class="list-unstyled">
             <?php
              getRecent();
             ?>

        
           </ol>
         </div>
       </aside>
      </div>

    </div>
  </div>

</main>
