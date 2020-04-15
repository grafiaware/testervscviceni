<button class="ui mini page button">Akce</button>

<div class="ui page dimmer transition hidden">
    <div class="content">
        <div class="center">
            <p><?= $userName ?></p>
            <form class="ui inverted form centered" method="POST" action="">
                <div class="field">
                    <button class="fluid ui primary labeled icon button" type="submit" name="app" value="rs" formtarget="_blank"
                            formmethod="GET" formaction="api/v1/useraction/app/rs">
                        <i class="edit outline large icon"></i>
                        Redakční systém
                    </button>
                </div>
                <div class="field">
                    <button class="fluid ui yellow labeled icon button" type="submit" name="app" value="edun" formtarget="_blank"
                            formmethod="GET" formaction="api/v1/useraction/app/edun">
                        <i class="file alternate outline large icon"></i>
                        Katalog kurzů
                    </button>
                </div>
                <div class="field">
                    <button class="fluid ui olive labeled icon button" type="submit" name="edit" value="<?= $edit ? 0 : 1 ?>" formtarget="_self"
                            formaction="api/v1/presentation/edit">
                        <i class="pencil alternate large icon"></i>
                        <?= $edit ? "Vypnout inline editaci" : "Zapnout inline editaci" ?>
                    </button>
                </div>
                <div class="field">
                    <button class="fluid ui secondary labeled icon button" type="submit" name="logout" value="1" formtarget="_self"
                            formaction='auth/v1/logout'>
                        <i class="sign out alternate large icon"></i>
                        Odhlásit se
                    </button>
                </div>
                <a class="ui hide button" href="javascript:void(0)">Zrušit</a>
            </form>
        </div>
    </div>
</div>

<script>
    $('.ui.page.button').click(function(){
       $('.page.dimmer').dimmer('show');
    });
    $('.ui.hide.button').click(function(){
       $('input').removeAttr("required");
       $('.page.dimmer').dimmer('hide');
    });
</script>





