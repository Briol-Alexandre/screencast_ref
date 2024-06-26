<?php
/** @var stdClass $jiri */

use Carbon\Carbon;




?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible"
              content="ie=edge">
        <title>Jiris</title>
        <link rel="stylesheet"
              href="<?= public_path('css/app.css') ?>">
    </head>
    <body>
        <a class="sr-only"
           href="#main-menu">Aller au menu principal</a>
        <div class="container mx-auto flex flex-col-reverse gap-6">
            <main class="flex flex-col gap-4">
                <h1 class="font-bold text-2xl"><?= $jiri->name ?></h1>
                <dl>
                    <div>
                        <dt class="font-bold">Nom</dt>
                        <dd><?= $jiri->name ?></dd>
                    </div>
                    <div>
                        <dt class="font-bold">Date et heure de début</dt>
                        <dd><?= Carbon::createFromFormat('Y-m-d H:i:s', $jiri->starting_at)
                                ->locale('fr')
                                ->diffForHumans() ?>
                        </dd>
                        <dd><?= Carbon::createFromFormat('Y-m-d H:i:s', $jiri->starting_at)
                                ->locale('fr')
                                ->toDateTimeString() ?>
                        </dd>
                    </div>
                </dl>
                <?php
                if (count($jiri->students)): ?>
                    <section>
                        <h2 class="font-bold">Les Étudiants</h2>
                        <ol>
                            <?php
                            foreach ($jiri->students as $student): ?>
                                <li><a href="/contact?id=<?= $student->id ?>"><?= $student->name ?>
                                        - <?= $student->email ?></a>
                                    <form action="/attendance" method="post">
                                        <?php method('patch');
                                        csrf_token();
                                        ?>
                                        <input type="hidden" name="jiri_id" value="<?= $jiri->id ?>">
                                        <input type="hidden" name="contact_id" value="<?= $student->id ?>">
                                        <input type="hidden" name="role" value="evaluator">
                                        <button type="submit"
                                                class="border-l-blue-50 bg-blue-500 text-white rounded-md px-4">
                                            Transformer en évaluateur
                                        </button>
                                    </form>
                                    <form action="/attendance" method="post">
                                        <?php method('delete');
                                        csrf_token();
                                        ?>
                                        <input type="hidden" name="jiri_id" value="<?= $jiri->id ?>">
                                        <input type="hidden" name="contact_id" value="<?= $student->id ?>">
                                        <button type="submit"
                                                class="border-l-red-50 bg-red-500 text-white rounded-md px-4">
                                            Supprimer du jiri
                                        </button>
                                    </form>
                                </li>
                            <?php
                            endforeach; ?>
                        </ol>
                    </section>
                <?php
                endif ?>
                <?php
                if (count($jiri->evaluators)): ?>
                    <section>
                        <h2 class="font-bold">Les Évaluateurs</h2>
                        <ol>
                            <?php
                            foreach ($jiri->evaluators as $evaluator): ?>
                                <li><a href="/contact?id=<?= $evaluator->id ?>"><?= $evaluator->name ?>
                                        - <?= $evaluator->email ?></a>
                                    <form action="/attendance" method="post">
                                        <?php method('patch');
                                        csrf_token();
                                        ?>
                                        <input type="hidden" name="jiri_id" value="<?= $jiri->id ?>">
                                        <input type="hidden" name="contact_id" value="<?= $evaluator->id ?>">
                                        <input type="hidden" name="role" value="student">
                                        <button type="submit"
                                                class="border-l-blue-50 bg-blue-500 text-white rounded-md px-4 m-3">
                                            Transformer en étudiant
                                        </button>
                                    </form>
                                    <form action="/attendance" method="post">
                                        <?php method('delete');
                                        csrf_token();
                                        ?>
                                        <input type="hidden" name="jiri_id" value="<?= $jiri->id ?>">
                                        <input type="hidden" name="contact_id" value="<?= $evaluator->id ?>">
                                        <button type="submit"
                                                class="border-l-red-50 bg-red-500 text-white rounded-md px-4">
                                            Supprimer du jiri
                                        </button>
                                    </form>
                                </li>

                            <?php
                            endforeach; ?>
                        </ol>
                    </section>
                <?php
                endif ?>
                <div>
                    <?php
                    /** @var ARRAY $contacts */
                    component('forms.contacts.create', compact('contacts')); ?>
                </div>
                <div>
                    <a href="/jiri/edit?id=<?= $jiri->id ?>"
                       class="underline text-blue-500">Modifier ce jiri</a>
                </div>
                <?php
                component('forms.jiris.delete', ['id' => $jiri->id]) ?>
            </main>
            <?php
            component('navigations.main'); ?>
        </div>
    </body>
</html>