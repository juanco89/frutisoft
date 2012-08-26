<!--
    Zend Framework Documentation
    See http://developer.yahoo.com/ypatterns/pattern.php?pattern=searchpagination
-->
 
<?php if ($this->pageCount): ?>
<div class="paginationControl">
<!-- Previous page link -->
<?php if (isset($this->previous)): ?>
  <a href="<?php echo $this->url(array('page' => $this->previous)); ?>">
    &lt; Anterior
  </a> |
<?php else: ?>
  <span class="disabled">&lt; Anterior</span> |
<?php endif; ?>
 
<!-- Numbered page links -->
<?php foreach ($this->pagesInRange as $page): ?>
  <?php if ($page != $this->current): ?>
    <a href="<?php echo $this->url(array('page' => $page)); ?>">
        <?php echo $page; ?>
    </a> |
  <?php else: ?>
    <?php echo $page; ?> |
  <?php endif; ?>
<?php endforeach; ?>
 
<!-- Next page link -->
<?php if (isset($this->next)): ?>
  <a href="<?php echo $this->url(array('page' => $this->next)); ?>">
    Siguiente &gt;
  </a>
<?php else: ?>
  <span class="disabled">Siguiente &gt;</span>
<?php endif; ?>
</div>
<?php endif; ?>