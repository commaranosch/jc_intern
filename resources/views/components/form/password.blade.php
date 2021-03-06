<div class="form-group">
    {{ Form::label($name, trans('form.' . $name)) }}
    <?php
    $class = 'form-control form-control-2d';
    if (array_key_exists('class', $attributes)) {
        $class .= ' ' . $attributes['class'];
    }
    ?>
    {{ Form::password($name, array_merge($attributes, ['class' => $class])) }}
</div>