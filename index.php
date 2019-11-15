<?php
/**
 * User: sgreep
 * Date: 10/8/2019
 */
$pagename = "Index";
require_once "header.inc.php";
?>
  <main>
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1>Programming With Style</h1>
        <h2><em>A compendium of design theory for those who think in bits &amp; bytes</em></h2>
          <button type="button" class="btn jumbo-btn btn-dark btn-lg" onclick="window.location.href = 'http://ccuresearch.coastal.edu/sgreep/csci303fa19/forms/login.php'">Start Learning</button>
      </div>
    </div>

    <section class="card-holder">
      <div class="card-deck">
        <div class="card">
          <a href="#"><img src="images/cell-card.jpg" class="card-img-top" alt="cell phone and design notebook on table"></a>
          <div class="card-body">
            <h5 class="card-title">Establishing Visual Hierarchy</h5>
            <p class="card-text">Learn to use typography, white space, and color to guide your user's eyes across the page.</p>
          </div>
          <div class="card-footer">
            <small class="text-muted">Published today.</small>
          </div>
        </div>
        <div class="card">
          <a href="#"><img src="images/middle-card.jpg" class="card-img-top" alt="desk with computer"></a>
          <div class="card-body">
            <h5 class="card-title">Designing for Accessibility</h5>
            <p class="card-text">Implementing accessibility features in your web design helps to make the internet usable for everyone, including those with disabilities.</p>
          </div>
          <div class="card-footer">
            <small class="text-muted">Published one week ago.</small>
          </div>
        </div>
        <div class="card">
          <a href="#"><img src="images/code-card.jpg" class="card-img-top" alt="MacBook with code on screen"></a>
          <div class="card-body">
            <h5 class="card-title">Typography for Developers</h5>
            <p class="card-text">A simple guide to typography for developers who want to make their websites more usable and beautiful.</p>
          </div>
          <div class="card-footer">
            <small class="text-muted">Published last month.</small>
          </div>
        </div>
      </div>
    </section>
  </main>
<?php
require_once "footer.inc.php";
?>
