<body>
<form action="" method="post" enctype="multipart/form-data">

    <div class="body-content">

        <div class="row">
            <?php
            $form = \yii\bootstrap\ActiveForm::begin([
                'id' => 'myform',
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'options' => ['class' => 'form-field'],
                    'labelOptions' => ['class' => ''],
                ],
            ]);
            ?>
            <table>
                <tr>
                    <td>Your username</td>
                    <td><input type="text" name="username" /></td>
                </tr>
                <tr>
                    <td>Upload image*</td>
                    <td><input type="file" name="uploadfile"/></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center;">
                        <input type="submit" name="submit" value="Upload" />
                    </td>
                </tr>
            </table>
            <?php
            $form->end();
            ?>
        </div>

    </div>
</form>
</body>