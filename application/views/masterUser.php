<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view($head); ?>
</head>

<body>
    <?php $navbar && $this->load->view($navbar); ?>
    <?php $this->load->view($content); ?>
    <?php $footer && $this->load->view($footer); ?>
    <?php $this->load->view($script); ?>
</body>

</html>