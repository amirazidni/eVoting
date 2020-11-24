<div style="text-align: center;">
    <h1>E-Voting</h1>
</div>

<div class="md-stepper-horizontal orange" style="margin-top: 32px;">
    <div class="md-step <?= $step >= 0 ? 'active' : '' ?> <?= $step > 0 ? 'done' : '' ?>">
        <div class="md-step-circle"><span>1</span></div>
        <div class="md-step-title">Panduan</div>
        <div class="md-step-bar-left"></div>
        <div class="md-step-bar-right"></div>
    </div>
    <div class="md-step <?= $step >= 1 ? 'active' : '' ?> <?= $step > 1 ? 'done' : '' ?>">
        <div class="md-step-circle"><span>2</span></div>
        <div class="md-step-title">Captcha</div>
        <div class="md-step-bar-left"></div>
        <div class="md-step-bar-right"></div>
    </div>
    <div class="md-step <?= $step >= 2 ? 'active' : '' ?> <?= $step > 2 ? 'done' : '' ?>">
        <div class="md-step-circle"><span>3</span></div>
        <div class="md-step-title">User Login</div>
        <div class="md-step-bar-left"></div>
        <div class="md-step-bar-right"></div>
    </div>
    <div class="md-step <?= $step >= 3 ? 'active' : '' ?> <?= $step > 3 ? 'done' : '' ?>">
        <div class="md-step-circle"><span>4</span></div>
        <div class="md-step-title">Foto</div>
        <!-- <div class="md-step-optional">Foto kamu atau foto KTM-mu</div> -->
        <div class="md-step-bar-left"></div>
        <div class="md-step-bar-right"></div>
    </div>
    <div class="md-step <?= $step >= 4 ? 'active' : '' ?> <?= $step > 4 ? 'done' : '' ?>">
        <div class="md-step-circle"><span>5</span></div>
        <div class="md-step-title">Voting</div>
        <div class="md-step-bar-left"></div>
        <div class="md-step-bar-right"></div>
    </div>
</div>