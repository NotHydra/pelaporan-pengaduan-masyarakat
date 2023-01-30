<?php
foreach ($inputArray as $inputObject) {
?>
    <div class="input-group mb-3">
        <input type="<?php echo $inputObject["type"]; ?>" class="form-control" id="<?php echo $inputObject["name"]; ?>" name="<?php echo $inputObject["name"]; ?>" value="<?php echo $inputObject["value"]; ?>" placeholder="<?php echo $inputObject["display"]; ?>" required>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-<?php echo $inputObject["icon"]; ?>"></span>
            </div>
        </div>
    </div>
<?php
};
?>