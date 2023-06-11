<div>
    <label for="username">
        Username
        <input id="username" minlength="5" name="username" type="text" placeholder="Enter username" required />
    </label>
</div>

<div>
    <label for="avatar">Choose image for avatar to upload (PNG, JPG)</label>

    <button
        onclick="document.getElementById('avatar').click()"
        class="btn btn-secondary"
        type="button"
    >
        Select file
    </button>

    <input
        accept=".jpg, .jpeg, .png"
        class="d-none"
        id="avatar"
        name="avatar"
        type="file"
    />

    <div class="preview">
        <p>No file currently selected for upload</p>
    </div>
</div>

<div>
    <label for="email">
        E-mail
        <input id="email" name="email" type="email" placeholder="Enter e-mail" required />
    </label>
</div>

<div>
    <label for="password">
        Password
        <input id="password" minlength="6" name="password" type="password" placeholder="Enter password" required />
    </label>
</div>

<div>
    <label for="repeat-password">
        Repeat password
        <input id="repeat-password" minlength="6" name="password" type="password" placeholder="Repeat password" required />
    </label>
</div>