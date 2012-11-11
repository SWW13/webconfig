<div class="page-header">
    <h1>Edit Domain</h1>
</div>

<form class="form-horizontal">
    <fieldset>
        <div class="control-group">
            <label for="DomainName" class="control-label">Domain</label>
            <div class="controls">
                <input id="DomainName" class="input-xlarge" value="<?= $domain['Domain']['domain']; ?>" maxlength="255" type="text" disabled/>
            </div>
        </div>
    </fieldset>
</form>