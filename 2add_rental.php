<?php require __DIR__ . '/parts/connect_db2.php';
$pageName = 'insert';
?>


<?php
$sql = "SELECT `sid`,`product_category` FROM `product_category`";
$rows = $pdo->query($sql)->fetchAll();
?>

<?php require __DIR__ . '/parts/html-head.php'; ?>
<?php include __DIR__ . '/parts/navbar.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">

                <div class="card-body">
                    <h5 class="card-title">租借商品上架</h5>

                    <img id="myimg" src="" alt="" width="300">

                    <form name="form1" onsubmit="checkForm(); return false;">
                        <input type="file" name="single" accept="image/png,image/jpeg" id="imgg">

                        <div class="mb-3">
                            <label for="name" class="form-label">租借品名</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <select name="sid" id="sid">
                            <?php foreach ($rows as $r) : ?>
                                <option value="<?= $r['sid'] ?>">
                                    <?= $r['product_category'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <div class="mb-3">
                            <label for="price" class="form-label">每日租價</label>
                            <input type="text" class="form-control" id="price" name="price" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>


                </div>
            </div>

        </div>
    </div>
</div>
<?php include __DIR__ . '/parts/scripts.php'; ?>
<script>
    let imgg = document.querySelector("#imgg");
    let myimg = document.querySelector("#myimg");
    imgg.addEventListener("change", (e) => {
        const file = e.target.files[0];
        myimg.src = URL.createObjectURL(file)
    })


    function checkForm() {
        const fd = new FormData(document.form1);

        fetch(`2add_rental_api.php`, {
            method: 'POST',
            body: fd
        }).then(r => r.json()).then(obj => {
            alert("新增完成");
            location.href = "2add_rental.php";
        })
    }
</script>


<?php include __DIR__ . '/parts/html-foot.php'; ?>