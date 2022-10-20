<section id="article-container" class="article-container">
<?php
    echo $this->getModule("pinned_knowledge");
    echo $this->getModule("knowledge_statistic",["__ks_limit" => 5]);
    echo $this->getModule("category_knowledge");
?>
</section>
