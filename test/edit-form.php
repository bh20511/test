<?php require __DIR__ . '/parts/connect_db.php';
$pageName = 'edit';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
if(empty($sid)){
    header('Location: list.php');
    exit;
}

$sql = "SELECT * FROM address_book WHERE sid=$sid";
$r = $pdo->query($sql)->fetch();
if(empty($r)){
    header('Location: list.php');
    exit;
}



?>
<?php require __DIR__ . '/parts/html-head.php'; ?>
<?php include __DIR__ . '/parts/navbar.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">

                <div class="card-body">
                    <h5 class="card-title">修改資料</h5>
                    <form name="form1" onsubmit="checkForm(); return false;" novalidate>
                        <input type="hidden" name="sid" value="<?= $r['sid'] ?>">
                        <div class="mb-3">
                            <label for="name" class="form-label">name</label>
                            <input type="text" class="form-control" id="name" name="name" required value="<?= htmlentities($r['name']) ?>">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">email</label>
                            <input type="email" class="form-control" id="email" name="email"  value="<?= $r['email'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="mobile" class="form-label">mobile</label>
                            <input type="text" class="form-control" id="mobile" name="mobile"  value="<?= $r['mobile'] ?>"
                            pattern="09\d{2}-?\d{3}-?\d{3}" >
                        </div>
                        <div class="mb-3">
                            <label for="birthday" class="form-label">birthday</label>
                            <input type="date" class="form-control" id="birthday" name="birthday"  value="<?= $r['birthday'] ?>" >
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">address</label>

                            <textarea class="form-control" name="address" id="address" 
                            cols="50" rows="3"><?= $r['address'] ?></textarea>
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
    function checkForm(){
        // document.form1.email.value

        const fd = new FormData(document.form1);

        for(let k of fd.keys()){
            console.log(`${k}: ${fd.get(k)}`);
        }
        // TODO: 檢查欄位資料

        fetch('edit-api.php', {
            method: 'POST',
            body: fd
        }).then(r=>r.json()).then(obj=>{
            console.log(obj);
            if(! obj.success){
                alert(obj.error);
            } else {
                alert('修改成功')
                // location.href = 'list.php';
            }
        })


    }
</script>
<?php include __DIR__ . '/parts/html-foot.php'; ?>