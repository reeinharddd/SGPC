<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGPC</title>
    <link rel="stylesheet" href="../../css/proyectos.css">
    <link rel="icon" href="../img/Logo1.png" type="image/png">
</head>

<body>
    <header class="header">
        <?php if (isset($_SESSION['admin_name']) && $current_page !== 'index.php') : ?>
        <div class="back-link">
            <a href="javascript:history.go(-1);">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAk1BMVEX/////pQD/ogD/oQD/0qD/pgD/nwD/897/qAD/+ev/9uX/9eL/rBH/6sP//ff/vlr/zoD/79T//PP/w2H/47X/7Mz/yG//+u7/4K3/8dn/0ov/u03/5bv/uUX/3ab/ryD/2Jr/zHv/tjv/sSr/1ZH/xmn/1pb/sCn/uEH/2KT/v2L/zIX/sjT/tSz/xWf/3aH/xHKGwhAOAAAMzUlEQVR4nN1d6WKCuhqEcERExd261q3W9tTb9v2f7qrdSMg3JAFMOPOzFcwYyCTf6nk1QBJPxq+vs1XL9kCqwcPs3ygMwyAIwvD81rY9nNIR7zoh838R+NP/1kQ+9C+ceASdie1RlYdk2xD5XcFmtgdWFlbnUMLvgsbK9tBKQbvHmJzghWLT9uiKI3mm+V2e06Xt8RVGl3pAf5abmr+KrU80gbdJPA9tD7IIHjs5/K4Ux7ZHaY7mGj+gdX8Tk+dG/gTeMLA9VDNM9jKJlyF8tj1WEwx39Aoj/oeNbI/WAOMNOYHMX486/F9ebA9XG/ER8Pu8vHWP/CweEtsj1gSQiHB/W1Xm/Ac69VJEIBEs2n59RmAYPVgdsR6ARDD2Hn9/qsn/p04MJy/kGxhs/g5K7Qb3r0ZtzvrJGykRzN+lXra6Mlyd6Ddwz+1b4oj/dz0Ytj4DcgKjLa8HAkMWE/d0CjOg8T3RblhDhu0l/YBusqej2jFEEsGtMD+oG0MgEezclV0hMAzctn4nC5+ewIV8xykwDJ1muNrQb+B6TlxUI4atKS0RnQ/6sk5dGCKJGIFh14Vhu0c/oB1oQKsHw2SrKREpiAydtOwP1vQDupdKRAoiQweNbUMDiUjBfYarEz2BpESk4DrDGEnEo8odHGc429CW0He1HabTDNs9kl/QUXXoOswQSkSflgjhEO8uQyQRL3RcRbL9H7+8uspwuKAnsPFES8RkGUT89DrKsHsAEkHvSob9y+8S8Y+pyDBvh3AXtKa0pRBJxOr2uwg2XxcZ0qcIhiSiPf3a+0T8R9xj2B6RE5g2ZWfw+COdEX96cI1hso2MThGDPwOc2wwNJWL4lPpdBIaiFcMqw+GCnsDGM5AIzo3vMMPumd6kgVPEw44/XTnLMDaViI7wYLvKkD5FYIk4Zn4XzDD4mA++0Ww9DO/m1W+O6AdU4ov4hcyNjxn6jT9Em/Ny+jS5g2ffVCLmS9nKm8NQuP8Fm9GsYpKmp4gn+eZci+HXtwSdRYVGRigR6BSxJi7TZ+hfT9SLqkIYgESEQCKSPnm6EhgKfnwS7FTJKgtPEbQvwuvSJn5ThpdXclf+yookAvgiWlPSgnplyJ8PlRleHtVlyU9qE50igEQAA9yNIT9MDYZ+sC/VQ7wlQ9IYm9I/JjDASRk28aeFbz6Ut6YOgLsa+SJo6SQYzvM+z3/3pqRZhBKxQMfA/GDgQgzLCueHpwjaGJY85U5gluFAj6Ef9IrzA0thJqIpjQltgEujw99hosnQDxZFCSJfRI+2FIrHQGWGIcsC3oAVk34oESBpZ3VSnQuBYfM4PY6u6C2vWN+wv+J8Pp9kg2GbIsoPJCI40mGDrewxUJUhjSRJhrODJD6gQMoCkogzshRGqvkUOgy/aM5kHljDEE0oEX1a4+c9DX66DC/Pxy5zC8PFprunJQIcA71nFYlIoaHtexlnNnYmEf0PQCLQMXCgnPDzezv9tJiuSDHUT1REiS1L+hg47CtKBAd9B9pKTB7Slf32Oy0RnUd6AlcHA35GuU19cQL0XuYPIBEjeqfbOppM4BX6eZSJsI/UcqTOgaHphCyFmitM6rYH/dV+LDBUfxEpi5h/izegJaKpJxHCnZfau5LkxN0h+Ef1wgmQiGLHQEzxqMvQe+e+kCkyHNK7ZeY/AVPvSyF+19svdU+yCxOGGadJegTAUkiH6mlQ7Mw0l0NurEoMY3q3zDof9Nd3jSRC8iX7x1iD5EybIch9DIClEOx9tCmyaN87Tnd9Avwyt9Jk2KQNKthSqFA2QIskAH/anmgxRBLBdrRYtYtIhDYEhjorDZIIdAykj8eVwJhhQu+WGQOWwjnlTKoKpgyRRCBLYRkSoQee4UCRIXQmFbcUlgqe4ZwfLMVwTFsKgzIshaXCgGELxBt0wGYd/C5VgmfY5v4nZzijDU0MFISLR/d/QG/QZRjTWhYcgER8FDtFFADPMOZsNRKG9HmVBchSuLTFT2TYwgzbYJN2BgEj95eIFHQYPoKwc5CZZEMiUlBnCJbQEGg8OB7fB8oMVyBka0vy81Z2JCIFnuGQYpj0yeTOoAcshSOV4mPVQo1hizQVMqTxKtXjKocSwwE50nBKT2AhS2F54BkmXPzbD8MJtVbAvAHl6nEVQ9gnyxhOiEuZ3wfOpLMTE+irMBwSi2gINH74ZlkiUshnKA+/Ygx4A7vK8QZ3QC7DifRpC17AMfBIJvXaQC5D2Z6ZNbYkP2/sgkSkkMdQFk0VgnN8/K8rK8wP8hi+ZRgyHyR+mHsDK0Mew7N4QdADpl6lCrF3Rg7DRAhfYBGw1dNZ2TaRx5CfFLanJ7BJu7mtQo/hCQRUhC5OoK89h580xbF7i8wNeQyFjwdr2idozV6IkbeWnoTPswbQirGLS00ew8/MmEMwjUPan2ENeQy7WYWDkg8q6VhC7r40I/n+Na8GlHQAZbetIJfhWLZNgeY1y/ZREfnnQ7kvO9yDoDe6YokF5DNsyy+EBbhUkl7uBQU7jRh3+oNgD4KaH50xYygw9GbEYGGyYpyXfHYvqDAUozL/EGxA4KEln68IFXvpRRWpPSd0+z44of+KfouYjKWHNSm7dEzK3aDI0PP6tG8tU3o6fZn1FUeZobeiA9UjsI0DRY/vA57hA/IBoyCFJQiD2tqdRi0/PnBzI/1vWoxT0GSIRC48AOGw6UjUYwjDTXwQUhq/W6OoGU8D30ZZvftfgGDGaqEf9YUcEyi0OykvtFsLBgxhCh7M0qaDiiuEUfTld+lCKYIlqqZjYRrNGHoJbauAzu/5/fVfiBHmx4rivCd0Sk+IqtzcXTjMY/VRYSsGglDi0X0f1QLZCF6T1n8GywqA0kHlo0hGCcx9QaUhyheOinJmvGtUgn3hYH502K+Xy54c/Puim/fkFRCOkiyOLNp1W+plA8f6DL1hnxYOFFgLEoc1+Pk7vYJIjwYMsXDAE0dhjyPb6LZSfzLKkjUXjvdiKw5ba2dzT80YWhIOk3R1foVTz+X2jIWjiMexo9D3QoBQbEmvgzeqC9WoQjgYqEdIQXjUQs3XeEXHlELhMHNVsRf9KkhCx1k/0C3fAmqUsAbo5ABKmwKG+pWsmmL8k0Hb4AGdIVpyWpTB6Jpi2Guw1WeICkFA4QBV6AloT+Eg4yky7FYKyyHD9MRK60RJisuwTyOC3lU4QO80EFusJRyaDAcSqzSjx5IHWC0KCAcotFiM4aQn+fGCnTHBC1YgV78c4RCrCj5vL3haXNHfXTG94qsO31L6gzeKlaId0jWOL8IBYhxUhUNguA2DX6gVUAyUOmUhgBNHIO8l+oUPtWkUGFLhFCQCg0JaGUDhALHUSsIh1C/Vre5ZUonWuWEdfRXhKFahlUVlNUikTxyw0LWCcBSrsuvrnpxpwEq0qARRXmaYWAtahyFrlFqYvSLhKFDPm3XKm8EboHCgHHAYHGfOkG3Kb1kG4jFQObcECYfQ0UqdYbA0LMyKAYWD3lvEtHCY9kZoPFXBzzMXDrJ3mVF/C+b3KmyqR584YBMdqtiPSY8Sv1dtCyEoHGCTKBcOPYbXvem+X31TRFBjOIT1ByUrjgbDRmPzcvy4T5dnVCc6gj0rM5fl9HtarMbfWHUn7Ye7NXy6no7o8hOw76g4ja727PKwcICuT+KJw2GG0FSFLI68cLjMEAqHDw6O3GLsdodH1CIAFkvpHmrSw9KDpyOUVfUnHM4zhCeOCHSy/DF8us/w2lKNFA62BsLxdeKoA0MoHD5Ix7k1QKkHQ+zjAMIxPgSNejDMEQ5w4tjVoS/3F1pTstYLFI4J7h7vEEPYYR0JBw+nGXrDNzPhSMNthsbCkYLrDFFdFCgcv3CfIWp4CIXjGzVgiIXjPS8CsRYMsXDk+DPrwfBa6A3UQYdRbHVhiKOqgI+jPgyxcAAfR40Yet4z6FozpUxVtWKICp8GVK2xlmCJKtlDWDpQVJU8HFe0tVVvwC+IeEpTjLayC2o2hx6MAGeSkiO1m0MPCwfLhOOKDO/jhymKyQstHKJxvJ4MUc4p80ecGUNkWF5r8YoBGkrxXlXBj89K7Q9fLUDOabpljxipUCOGXvudnsa/Bu1N/j+GEdy2gDov/aw4QlxbVCw69u4AVe5Y8LXiCNGXJp1+7WKyp4Xjlqv6wTMs1FXcDpIFHY/JTv0tX6OT7W2P1wQo51Rkb9Cg1Amo55yGhaPULQEIB49GTTZtEqwiFY5saXucBQDaLqYY6vdMdwkgquoHh5rpvYhsBJiA4tkw1hHDJktsXz+5zwIWZK6DBSMfQ7JbnUmKt5to96SV/MOF7YGViO4566sKn22PqlzMzixNkoWnfF9q3TB42wfhLakyCMP9a+2OhUoYTl7/ueB1ZaLz/wdNRu9L5PqrwwAAAABJRU5ErkJggg=="
                    alt="Flecha de regreso">
            </a>
        </div>
        <?php endif; ?>

        <div class="logo">
            <img src="../img/Logo1.png" alt="Logo de la empresa">
        </div>

        <div class="user-info">
            <img src="../img/account-icon-user-icon-vector-graphics_292645-552.avif" alt="Nombre del usuario">
            <h3><?php echo $_SESSION['admin_name']; ?>
                <p>Administrador</p>
            </h3>
        </div>




    </header>
</body>