<!-- PONTOS -->
<? $campo = ['CPF', 'CPF', 'text', 14, ' required minlength="14" onkeypress="return mascaraCPF(CPF)" '] ?>
<label for="<?= $campo[2] ?>" ><?= $campo[1] ?>:</label>
<input type="<?= $campo[2] ?>" id="<?= $campo[0] ?>" name="<?= $campo[0] ?>" maxlength="<?= $campo[3] ?>" <?= $campo[4] ?> >

<!-- SENHA -->
<? $campo = ['SENHA', 'Senha', 'password', 20, ' required '] ?>
<label for="<?= $campo[0] ?>" >Senha:</label>
<input type="<?= $campo[2] ?>" id="<?= $campo[0] ?>" name="<?= $campo[0] ?>" maxlength="<?= $campo[3] ?>" <?= $campo[4] ?>>