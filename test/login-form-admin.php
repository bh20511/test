<?php require __DIR__ . '/parts/html-head.php'; ?>
<?php include __DIR__ . '/parts/navbar.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">

                <div class="card-body">
                    <h5 class="card-title">登入</h5>

                    <form name="form1" onsubmit="checkForm(); return false;">
                        <div class="mb-3">
                            <label for="account" class="form-label">帳號</label>
                            <input type="text" class="form-control" id="account" name="account">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">密碼</label>
                            <input type="password" class="form-control" id="password" name="password">
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
    async function checkForm() {

        const fd = new FormData(document.form1);

        const r = await fetch('login-api-admin.php', {
            method: 'POST',
            body: fd,
        });

        const obj = await r.json();
        console.log(obj);
        if(obj.success){
            location.href='basepage.php';
        }else{
            alert(obj.error);
        }
    }
</script>
<?php include __DIR__ . '/parts/html-foot.php'; ?>