<table class="table table-sm  table-striped table-hover table-bordered rounded-1 overflow-hidden fs-6"
    style="font-size: 14px !important;">
    <tbody>
        <tr>
            <th>Layout</th>
            <td><?php echo (new \_ThemeName\PostType)->get_layout()  ?></td>
        </tr>
        <tr>
            <th>Author</th>
            <td><?php echo (new \_ThemeName\PostType)->get_author()  ?></td>
            </td>
        </tr>

        <tr>
            <th>Date</th>
            <td><?php echo (new \_ThemeName\PostType)->get_date()  ?></td>
            </td>
        </tr>

    </tbody>
</table>