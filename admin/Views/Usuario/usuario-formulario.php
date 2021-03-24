<? $campo = ['CPF', 'Cpf', 'text', 14, ' required onkeypress="return mascaraCPF(CPF)" '] ?>
<label for="<?= $campo[0] ?>"><?= $campo[1] ?>:</label>
<input type="<?= $campo[2] ?>" id="<?= $campo[0] ?>" name="<?= $campo[0] ?>" value="<?= @$this->dado[$campo[0]] ?>" maxlength="<?= $campo[3] ?>" <?= $campo[4] ?>>

<? $campo = ['NOME', 'Nome', 'text', 50, ' required onblur="return validaNomeSobrenome(NOME)" minlength="3" '] ?>
<label for="<?= $campo[0] ?>"><?= $campo[1] ?>:</label>
<input type="<?= $campo[2] ?>" id="<?= $campo[0] ?>" name="<?= $campo[0] ?>" value="<?= @$this->dado[$campo[0]] ?>" maxlength="<?= $campo[3] ?>" <?= $campo[4] ?>>

<? $campo = ['SENHA', 'Senha', 'password', 20, ' required minlength="3" '] ?>
<label for="<?= $campo[0] ?>"><?= $campo[1] ?>:</label>
<input type="<?= $campo[2] ?>" id="<?= $campo[0] ?>" name="<?= $campo[0] ?>" value="<?= @$this->dado[$campo[0]] ?>" <?= $campo[4] ?>>