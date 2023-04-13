<?php
/**
 * Add settings page to the admin menu.
 */
?>

<div class="wrap" id="yaytb_wrap_setting">
    <h1>YayBlog</h1>
    <hr>
    <h3>Review settings</h3>
    <form action="./settings.php" method="post">
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">Review</th>
                    <td>
                        <select name="yaytb_review" id="yaytb_review">
                            <option value="5">Out of 5</option>
                            <option value="10">Out of 10</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th scope="row">UI</th>
                    <td>
                        <select name="yaytb_ui" id="yaytb_ui">
                            <option value="tooltip">Tooltip</option>
                            <option value="icon">Icon</option>
                            <option value="badge">Badge</option>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
        <p class="submit">
            <input type="submit" name="submit" class="button button-primary" value="Save Change">
        </p>
    </form>
</div>
