<?php require __DIR__ . '/parts/connect_db.php';
$pageName = 'insert';
?>
<?php require __DIR__ . '/parts/html-head.php'; ?>
<?php include __DIR__ . '/parts/navbar.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">

                <div class="card-body">
                    <h5 class="card-title">新增資料</h5>
                    <form name="form1" onsubmit="checkForm(); return false;">
                        <div class="mb-3">
                            <label for="name" class="form-label">name</label>
                            <input type="text" class="form-control" id="name" name="name" required >
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">email</label>
                            <input type="text" class="form-control" id="email" name="email" >
                        </div>
                        <div class="mb-3">
                            <label for="mobile" class="form-label">mobile</label>
                            <input type="text" class="form-control" id="mobile" name="mobile" pattern="09\d{2}-?\d{3}-?\d{3}" >
                        </div>
                        <div class="mb-3">
                            <label for="birthday" class="form-label">birthday</label>
                            <input type="date" class="form-control" id="birthday" name="birthday" >
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">address</label>

                            <textarea class="form-control" name="address" id="address" 
                            cols="50" rows="3"></textarea>
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
        const fd = new FormData(document.form1);
        for(let k of fd.keys()){
            console.log(`${k}:${fd.get(k)}`);
        }
        fetch(`insert-api.php`,{
            method:'POST',
            body:fd
        }).then(r=>r.json()).then(obj=>{
            console.log(obj);
        })



        
    }
</script>
<?php include __DIR__ . '/parts/html-foot.php'; ?>