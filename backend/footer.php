<?php
    if($page == "index") {
        $footer = "<script src='{$filepath}assets/js/index.js'></script>";
    }
    if($page == "inventory") {
        $footer = "<script src='assets/js/inventory.js'></script>
        <script src='assets/js/sell-modal.js'></script>
        <script src='assets/js/ajax.js'></script>";
    }
    if($page == "history") {
        $footer = "<script src='assets/js/index.js'></script>";
    }
    if($page == "listing") {
        $footer = "<script src='assets/js/buy-modal.js'></script>
        <script src='assets/js/sell-modal.js'></script>
        <script src='assets/js/ajax.js'></script>
        <script src='assets/js/listing.js'></script>";
    }
    if($page == "search") {
        $footer = "<script src='assets/js/search.js'></script>";
    }
    if($categories) {
         echo "                <div class='col-xs-6 searchActivity'>
                    <div class='col-xs-24'>
                        <h3 class='searchTitle'>Find Items</h3>
                        <p class='searchText'>Looking for a specific item?</p>
                    </div>
                    <div class='searchBox col-xs-24'>
                        <form method='get' action='search.php'>
                            <div class='input-group'>
                                <input type='text' class='search-query form-control searchBar' placeholder='Search' id='query' name='query' />
                                <span class='input-group-btn blackButton'>
                                    <button class='btn blackButton' type='submit' style='height: 33px; top:0px;'>
                                        <span class='glyphicon glyphicon-search'></span>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class='searchByCategory col-xs-24'>
                        <p class='categorySearch'>Browse by category:</p>
                        <div class='categoryTable'>";
                            $max = count($category);
                            for($i = 0; $i < $max; $i++) {
                                echo "
                                <a href='{$filepath}search.php?category={$i}'>
                                    <div class='categoryRow'>{$category[$i]}</div>
                                </a>";
                            }
                          echo "
                         </div>
                    </div>
                </div>";
        }
    $html = "
            </div>
        </div>
    </body>
    {$footer}
</html>";
echo $html;
?>
