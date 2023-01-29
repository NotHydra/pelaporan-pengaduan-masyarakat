<?php
foreach ($inputArray as $inputObject) {
?>
    <div class="form-group">
        <label for="<?php echo $inputObject["name"]; ?>"><?php echo $inputObject["display"]; ?></label>

        <?php
        if ($inputObject["enable"]) {
            if (!in_array($inputObject["type"], ["select", "textarea", "image"])) {
        ?>
                <input class="form-control" id="<?php echo $inputObject["name"]; ?>" style="width: 100%;" type="<?php echo $inputObject["type"]; ?>" name="<?php echo $inputObject["name"]; ?>" value="<?php echo $inputObject["value"]; ?>" placeholder="<?php echo $inputObject["placeholder"]; ?>" required />
            <?php
            } else if ($inputObject["type"] == "select") {
            ?>
                <select class="form-control select2bs4" id="<?php echo $inputObject["name"]; ?>" style="width: 100%;" name="<?php echo $inputObject["name"]; ?>" required>
                    <option value=""><?php echo $inputObject["placeholder"]; ?></option>

                    <?php
                    foreach ($inputObject["value"][0] as $optionObject) {
                        if ($inputObject["value"][1] == $optionObject[0]) {
                    ?>
                            <option value="<?php echo $optionObject[0]; ?>" selected><?php echo $optionObject[1]; ?></option>
                        <?php
                        } else {
                        ?>
                            <option value="<?php echo $optionObject[0]; ?>"><?php echo $optionObject[1]; ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
            <?php
            } else if ($inputObject["type"] == "textarea") {
            ?>
                <textarea class="form-control" id="<?php echo $inputObject["name"]; ?>" style="width: 100%;" name="<?php echo $inputObject["name"]; ?>" placeholder="<?php echo $inputObject["placeholder"]; ?>" rows="5" required><?php echo $inputObject["value"]; ?></textarea>
            <?php
            } else if ($inputObject["type"] == "image") {
            ?>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" accept="image/*" id="<?php echo $inputObject["name"]; ?>" style="width: 100%;" name="<?php echo $inputObject["name"]; ?>" onchange="loadImage(this.id, event)" required>
                        <label class="custom-file-label" for="<?php echo $inputObject["name"]; ?>"><?php echo $inputObject["placeholder"]; ?></label>
                    </div>
                </div>

                <div class="mt-2" style="border: 1px solid #cfd5db; border-radius: 8px; overflow: auto;">
                    <img class="m-auto d-block" id="<?php echo $inputObject["name"]; ?>-image" src="<?php echo $inputObject["value"] == null ? '' : $sourcePath . '/public/dist/img/storage/' . $inputObject["value"]; ?>" height="300px">
                </div>
            <?php
            }
        } else {
            if (!in_array($inputObject["type"], ["textarea", "image"])) {
            ?>
                <input class="form-control" id="<?php echo $inputObject["name"]; ?>" style="width: 100%;" type="<?php echo $inputObject["type"]; ?>" name="<?php echo $inputObject["name"]; ?>" value="<?php echo $inputObject["value"]; ?>" placeholder="<?php echo $inputObject["placeholder"]; ?>" disabled />
            <?php
            } else if ($inputObject["type"] == "textarea") {
            ?>
                <textarea class="form-control" id="<?php echo $inputObject["name"]; ?>" style="width: 100%;" name="<?php echo $inputObject["name"]; ?>" placeholder="<?php echo $inputObject["placeholder"]; ?>" rows="5" disabled><?php echo $inputObject["value"]; ?></textarea>
            <?php
            } else if ($inputObject["type"] == "image") {
            ?>
                <div class="my-3" style="border: 1px solid #cfd5db; border-radius: 8px; overflow: auto;">
                    <img class="m-auto d-block" id="<?php echo $inputObject["name"]; ?>-image" src="<?php echo $inputObject["value"] == null ? '' : $sourcePath . '/public/dist/img/storage/' . $inputObject["value"]; ?>" height="300px">
                </div>
        <?php
            };
        };
        ?>
    </div>

    <script src="<?php echo $sourcePath; ?>/public/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });

        function loadImage(elementId, event) {
            document.getElementById(`${elementId}-image`).src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
<?php
}
?>