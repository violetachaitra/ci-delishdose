<!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link <?php echo (uri_string() == '') ? "" : "collapsed" ?>" href="/">
          <i class="bi bi-grid"></i>
          <span>Home</span>
        </a>
      </li><!-- End Home Nav -->

      <?php
        if (session()->get('role') == 'admin') {
        ?>
      <li class="nav-item">
        <a class="nav-link <?php echo (uri_string() == 'dashboard') ? "" : "collapsed" ?>" href="dashboard">
          <i class="bi bi-bar-chart"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <?php
        }
        ?>

      <li class="nav-item">
        <a class="nav-link <?php echo (uri_string() == 'keranjang') ? "" : "collapsed" ?>" href="keranjang">
          <i class="bi bi-cart-check"></i>
          <span>Keranjang</span>
        </a>
      </li><!-- End Keranjang Nav -->

      <li class="nav-item">
          <a class="nav-link <?php echo (uri_string() == 'profile') ? "" : "collapsed" ?>" href="profile">
              <i class="bi bi-person"></i>
              <span>Riwayat Transaksi</span>
          </a>
      </li><!-- End Profile Nav -->
      
      <?php
      if (session()->get('role') == 'admin') {
      ?>
        <li class="nav-item">
          <a class="nav-link <?php echo (uri_string() == 'produk') ? "" : "collapsed" ?>" href="produk">
            <i class="bi bi-receipt"></i>
            <span>Produk</span>
          </a>
        </li><!-- End Produk Nav -->
      <?php
      }
      ?>

      <?php
        if (session()->get('role') == 'admin') {
        ?>
      <li class="nav-item">
          <a class="nav-link <?php echo (uri_string() == 'penjualan') ? "" : "collapsed" ?>" href="penjualan">
              <i class="bi bi-card-list"></i>
              <span>Status Penjualan</span>
          </a>
      </li><!-- End Penjualan Nav -->
      <?php
        }
        ?>
 
      <?php
        if (session()->get('role') == 'admin') {
        ?>
      <li class="nav-item">
      <a class="nav-link <?php echo (uri_string() == 'laporan-penjualan') ? "" : "collapsed" ?>" href="laporan-penjualan">
              <i class="bi bi-printer"></i>
              <span>Laporan Penjualan</span>
          </a>
      </li><!--End Laporan Penjualan Nav-->
      <?php
      }
      ?>

<li class="nav-item">
          <a class="nav-link <?php echo (uri_string() == 'faq') ? "" : "collapsed" ?>" href="faq">
              <i class="bi bi-question-circle"></i>
              <span>F.A.Q</span>
          </a>
      </li><!-- End FAQ Nav -->

      <li class="nav-item">
          <a class="nav-link <?php echo (uri_string() == 'contact') ? "" : "collapsed" ?>" href="contact">
              <i class="bi bi-telephone"></i>
              <span>Contact</span>
          </a>
      </li><!-- End Contact Nav -->
      
    </ul>

  </aside><!-- End Sidebar-->