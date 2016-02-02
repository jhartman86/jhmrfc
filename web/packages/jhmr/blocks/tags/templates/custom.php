<?php defined('C5_EXECUTE') or die("Access Denied.");
use Concrete\Attribute\Select\OptionList;

if ($options instanceof OptionList && $options->count() > 0):
    foreach($options as $option) { ?>
        <a class="tag-item" href="<?php echo $controller->getTagLink($option) ?>">
            <span class="ccm-block-tags-tag label"><?php echo $option->getSelectAttributeOptionValue(); ?></span>
        </a>
    <? }
endif; ?>