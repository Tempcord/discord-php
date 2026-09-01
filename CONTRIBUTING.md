# Contributing

## Commit messages decide releases

Merges are squashed, and the pull request title becomes the commit subject on
`master`. That subject is read by semantic-release, which cuts the tag and the
GitHub release — so the title is not a formality, it is the version bump.

Titles follow [Conventional Commits](https://www.conventionalcommits.org):

```
feat(components): add addButton to the message builders
fix(rest): map createChannel as a single object
docs(readme): show the reply shorthand
```

| Prefix | Release |
| --- | --- |
| `fix`, `perf` | patch — `1.2.3` → `1.2.4` |
| `feat` | minor — `1.2.3` → `1.3.0` |
| `feat!`, or `BREAKING CHANGE:` in the body | major — `1.2.3` → `2.0.0` |
| `docs`, `test`, `refactor`, `build`, `ci`, `chore` | none |

A pull request whose title does not parse is rejected by a check before it can
be merged, because a subject semantic-release cannot read is a release that
silently never happens.

Put the reasoning in the pull request body. It becomes the commit body, and it
is the part someone reads in a year when they are trying to work out why.

## Breaking changes

Mark them, and say what to do instead:

```
feat(interaction)!: replace replyEphemeral with an ephemeral argument

BREAKING CHANGE: replyEphemeral() is gone. Call reply(..., ephemeral: true).
```

## Before opening a pull request

```bash
composer test   # PHPUnit
composer cs     # code style, dry run; composer csf writes the fixes
```
