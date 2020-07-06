<div class="three columns">

  <span class="arrondi">
    <!-- Search -->
    <div class="row" style='margin-top: 1vw;'>
      <div class="two columns">
      <svg viewBox="0 0 24 24" class="logo-menu color-theme"><g><path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path></g></svg>
      </div>
      <div class="ten columns">
        <!-- <input type="text" name="recherche" id="rechercher" placeholder="Recherche Twitter"> -->
        <form id='search-content-form'> 
          <input type='text' id='search-content' placeholder='Search'>
          <input class="button btn-color-theme color-theme" type="submit" id='search-submit' value="Search">
        </form>
      </div>
    </div>
  </span>
  <!-- Trending -->
  <div class="tendances">
    <div class="container-fluid">
      <div class="row">
        <div column class='trending-title'>
          <strong>Tendances</strong>
        </div>
        <span id='trend-tag-container'></span>
      </div>
    </div>
  </div>
  <!-- Suggestions -->
  <div class="suggestions">
    <div class="container-fluid">
      <div class="row">
        <div class='trending-title'>
            <strong>Suggestions</strong>
          </div>
          <div id="suggestion#1" class='trending' column>
            Le Style incroyable de Faudel
          </div>
          <div id="suggestion#2" class='trending' column>
            UberEats sushis
          </div>
          <div id="suggestion#3" class='trending' column>
            Five porte de clichy en construction
          </div>
          <div id="suggestion#4" class='trending' column>
            Comment reussir l'exam SQL ?
          </div>
      </div>
    </div>
  </div>
</div>