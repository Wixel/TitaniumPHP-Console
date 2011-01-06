<?php if (is_array($this->includes)): ?>

<?php foreach ($this->includes as $class): ?>
- <?php echo $this->eprint($class); ?> 
<?php endforeach; ?>
<?php else: ?>
    
    There are currently no classes loaded.
    
<?php endif; ?>