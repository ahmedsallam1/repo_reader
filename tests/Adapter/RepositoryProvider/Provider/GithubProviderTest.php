<?php
namespace App\Tests\Adapter\RepositoryProvider\Provider;

use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpClient\Response\MockResponse;
use App\Adapter\RepositoryProvider\Provider\GithubProvider;
use App\Adapter\RepositoryProvider\Contract\RepositoryProviderInterface;

class GithubProviderTest extends WebTestCase
{
    /**
     * @var		mixed	$provider
     */
    private $provider;

    /**
     * setUp.
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Tuesday, December 1st, 2020.
     * @access	protected
     * @return	void
     */
    protected function setUp(): void
    {
        self::bootKernel();

        $this->provider = new GithubProvider(new MockHttpClient(new MockResponse(
            json_encode([
                'total_count' => count($this->mockedGithubRepositories()),
                'items' => $this->mockedGithubRepositories()
            ], true)
        )));
    }    

    /**
     * test_find_should_return_instance_of_provider_interface.
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Tuesday, December 1st, 2020.
     * @access	public
     * @return	void
     */
    public function test_find_should_return_instance_of_provider_interface()
    {
        $this->assertInstanceOf(RepositoryProviderInterface::class, $this->provider->find());
    }

    /**
     * test_find_items_should_return_mocked_github_repositories.
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Tuesday, December 1st, 2020.
     * @access	public
     * @return	void
     */
    public function test_find_items_should_return_mocked_github_repositories()
    {
        $this->assertTrue($this->provider->find()->items() === $this->mockedGithubRepositories());
    }

    /**
     * test_find_total_count_should_return_count_of_mocked_github_repositories.
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Tuesday, December 1st, 2020.
     * @access	public
     * @return	void
     */
    public function test_find_total_count_should_return_count_of_mocked_github_repositories()
    {
        $this->assertEquals($this->provider->find()->totalCount(), count($this->mockedGithubRepositories()));
    }

    /**
     * test_find_paginated_should_return_array_of_pagination.
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Tuesday, December 1st, 2020.
     * @access	public
     * @return	void
     */
    public function test_find_paginated_should_return_array_of_pagination()
    {
        $this->assertArrayHasKey('pagination', $this->provider->find()->paginated());
    }

    /**
     * test_find_paginated_should_return_array_of_pagination_with_total_count.
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Tuesday, December 1st, 2020.
     * @access	public
     * @return	void
     */
    public function test_find_paginated_should_return_array_of_pagination_with_total_count()
    {
        $this->assertArrayHasKey('total_count', $this->provider->find()->paginated()['pagination']);
    }

    /**
     * test_find_paginated_should_return_array_of_data.
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Tuesday, December 1st, 2020.
     * @access	public
     * @return	void
     */
    public function test_find_paginated_should_return_array_of_data()
    {
        $this->assertArrayHasKey('data', $this->provider->find()->paginated());
    }

    /**
     * test_scope_query_should_add_q_parameter.
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Tuesday, December 1st, 2020.
     * @access	public
     * @return	void
     */
    public function test_scope_query_should_add_q_parameter()
    {
        $this->provider->scopeQuery('test');

        $this->assertArrayHasKey('q', $this->provider->getParameters());
    }

    /**
     * test_scope_query_should_add_q_parameter_with_given_value.
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Tuesday, December 1st, 2020.
     * @access	public
     * @return	void
     */
    public function test_scope_query_should_add_q_parameter_with_given_value()
    {
        $this->provider->scopeQuery('test');
        $this->assertEquals('test', $this->provider->getParameters()['q']);
    }

    /**
     * mockedGithubRepositories.
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Tuesday, December 1st, 2020.
     * @access	private
     * @return	array
     */
    private function mockedGithubRepositories()
    {
        return [
            array(
                'id' => 35130077,
                'node_id' => 'MDEwOlJlcG9zaXRvcnkzNTEzMDA3Nw==',
                'name' => 'a',
                'full_name' => 'angular/a',
                'private' => false,
                'owner' => array(
                    'login' => 'angular',
                    'id' => 139426,
                    'node_id' => 'MDEyOk9yZ2FuaXphdGlvbjEzOTQyNg==',
                    'avatar_url' => 'https://avatars3.githubusercontent.com/u/139426?v=4',
                    'gravatar_id' => '',
                    'url' => 'https://api.github.com/users/angular',
                    'html_url' => 'https://github.com/angular',
                    'followers_url' => 'https://api.github.com/users/angular/followers',
                    'following_url' => 'https://api.github.com/users/angular/following{/other_user}',
                    'gists_url' => 'https://api.github.com/users/angular/gists{/gist_id}',
                    'starred_url' => 'https://api.github.com/users/angular/starred{/owner}{/repo}',
                    'subscriptions_url' => 'https://api.github.com/users/angular/subscriptions',
                    'organizations_url' => 'https://api.github.com/users/angular/orgs',
                    'repos_url' => 'https://api.github.com/users/angular/repos',
                    'events_url' => 'https://api.github.com/users/angular/events{/privacy}',
                    'received_events_url' => 'https://api.github.com/users/angular/received_events',
                    'type' => 'Organization',
                    'site_admin' => false
                ),
                'html_url' => 'https://github.com/angular/a',
                'description' => 'Library for annotating ES5',
                'fork' => false,
                'url' => 'https://api.github.com/repos/angular/a',
                'forks_url' => 'https://api.github.com/repos/angular/a/forks',
                'keys_url' => 'https://api.github.com/repos/angular/a/keys{/key_id}',
                'collaborators_url' => 'https://api.github.com/repos/angular/a/collaborators{/collaborator}',
                'teams_url' => 'https://api.github.com/repos/angular/a/teams',
                'hooks_url' => 'https://api.github.com/repos/angular/a/hooks',
                'issue_events_url' => 'https://api.github.com/repos/angular/a/issues/events{/number}',
                'events_url' => 'https://api.github.com/repos/angular/a/events',
                'assignees_url' => 'https://api.github.com/repos/angular/a/assignees{/user}',
                'branches_url' => 'https://api.github.com/repos/angular/a/branches{/branch}',
                'tags_url' => 'https://api.github.com/repos/angular/a/tags',
                'blobs_url' => 'https://api.github.com/repos/angular/a/git/blobs{/sha}',
                'git_tags_url' => 'https://api.github.com/repos/angular/a/git/tags{/sha}',
                'git_refs_url' => 'https://api.github.com/repos/angular/a/git/refs{/sha}',
                'trees_url' => 'https://api.github.com/repos/angular/a/git/trees{/sha}',
                'statuses_url' => 'https://api.github.com/repos/angular/a/statuses/{sha}',
                'languages_url' => 'https://api.github.com/repos/angular/a/languages',
                'stargazers_url' => 'https://api.github.com/repos/angular/a/stargazers',
                'contributors_url' => 'https://api.github.com/repos/angular/a/contributors',
                'subscribers_url' => 'https://api.github.com/repos/angular/a/subscribers',
                'subscription_url' => 'https://api.github.com/repos/angular/a/subscription',
                'commits_url' => 'https://api.github.com/repos/angular/a/commits{/sha}',
                'git_commits_url' => 'https://api.github.com/repos/angular/a/git/commits{/sha}',
                'comments_url' => 'https://api.github.com/repos/angular/a/comments{/number}',
                'issue_comment_url' => 'https://api.github.com/repos/angular/a/issues/comments{/number}',
                'contents_url' => 'https://api.github.com/repos/angular/a/contents/{+path}',
                'compare_url' => 'https://api.github.com/repos/angular/a/compare/{base}...{head}',
                'merges_url' => 'https://api.github.com/repos/angular/a/merges',
                'archive_url' => 'https://api.github.com/repos/angular/a/{archive_format}{/ref}',
                'downloads_url' => 'https://api.github.com/repos/angular/a/downloads',
                'issues_url' => 'https://api.github.com/repos/angular/a/issues{/number}',
                'pulls_url' => 'https://api.github.com/repos/angular/a/pulls{/number}',
                'milestones_url' => 'https://api.github.com/repos/angular/a/milestones{/number}',
                'notifications_url' => 'https://api.github.com/repos/angular/a/notifications{?since,all,participating}',
                'labels_url' => 'https://api.github.com/repos/angular/a/labels{/name}',
                'releases_url' => 'https://api.github.com/repos/angular/a/releases{/id}',
                'deployments_url' => 'https://api.github.com/repos/angular/a/deployments',
                'created_at' => '2015-05-06T00:02:24Z',
                'updated_at' => '2020-11-22T12:40:29Z',
                'pushed_at' => '2018-04-12T18:05:36Z',
                'git_url' => 'git://github.com/angular/a.git',
                'ssh_url' => 'git@github.com:angular/a.git',
                'clone_url' => 'https://github.com/angular/a.git',
                'svn_url' => 'https://github.com/angular/a',
                'homepage' => null,
                'size' => 121,
                'stargazers_count' => 67,
                'watchers_count' => 67,
                'language' => 'JavaScript',
                'has_issues' => true,
                'has_projects' => true,
                'has_downloads' => true,
                'has_wiki' => true,
                'has_pages' => false,
                'forks_count' => 29,
                'mirror_url' => null,
                'archived' => true,
                'disabled' => false,
                'open_issues_count' => 7,
                'license' => null,
                'forks' => 29,
                'open_issues' => 7,
                'watchers' => 67,
                'default_branch' => 'master',
                'score' => 1
            ),
            array(
                'id' => 2994936,
                'node_id' => 'MDEwOlJlcG9zaXRvcnkyOTk0OTM2',
                'name' => 'aFileChooser',
                'full_name' => 'iPaulPro/aFileChooser',
                'private' => false,
                'owner' => array(
                    'login' => 'iPaulPro',
                    'id' => 354227,
                    'node_id' => 'MDQ6VXNlcjM1NDIyNw==',
                    'avatar_url' => 'https://avatars3.githubusercontent.com/u/354227?v=4',
                    'gravatar_id' => '',
                    'url' => 'https://api.github.com/users/iPaulPro',
                    'html_url' => 'https://github.com/iPaulPro',
                    'followers_url' => 'https://api.github.com/users/iPaulPro/followers',
                    'following_url' => 'https://api.github.com/users/iPaulPro/following{/other_user}',
                    'gists_url' => 'https://api.github.com/users/iPaulPro/gists{/gist_id}',
                    'starred_url' => 'https://api.github.com/users/iPaulPro/starred{/owner}{/repo}',
                    'subscriptions_url' => 'https://api.github.com/users/iPaulPro/subscriptions',
                    'organizations_url' => 'https://api.github.com/users/iPaulPro/orgs',
                    'repos_url' => 'https://api.github.com/users/iPaulPro/repos',
                    'events_url' => 'https://api.github.com/users/iPaulPro/events{/privacy}',
                    'received_events_url' => 'https://api.github.com/users/iPaulPro/received_events',
                    'type' => 'User',
                    'site_admin' => false
                ),
                'html_url' => 'https://github.com/iPaulPro/aFileChooser',
                'description' => '[DEPRECATED] Android library that provides a file explorer to let users select files on external storage.',
                'fork' => false,
                'url' => 'https://api.github.com/repos/iPaulPro/aFileChooser',
                'forks_url' => 'https://api.github.com/repos/iPaulPro/aFileChooser/forks',
                'keys_url' => 'https://api.github.com/repos/iPaulPro/aFileChooser/keys{/key_id}',
                'collaborators_url' => 'https://api.github.com/repos/iPaulPro/aFileChooser/collaborators{/collaborator}',
                'teams_url' => 'https://api.github.com/repos/iPaulPro/aFileChooser/teams',
                'hooks_url' => 'https://api.github.com/repos/iPaulPro/aFileChooser/hooks',
                'issue_events_url' => 'https://api.github.com/repos/iPaulPro/aFileChooser/issues/events{/number}',
                'events_url' => 'https://api.github.com/repos/iPaulPro/aFileChooser/events',
                'assignees_url' => 'https://api.github.com/repos/iPaulPro/aFileChooser/assignees{/user}',
                'branches_url' => 'https://api.github.com/repos/iPaulPro/aFileChooser/branches{/branch}',
                'tags_url' => 'https://api.github.com/repos/iPaulPro/aFileChooser/tags',
                'blobs_url' => 'https://api.github.com/repos/iPaulPro/aFileChooser/git/blobs{/sha}',
                'git_tags_url' => 'https://api.github.com/repos/iPaulPro/aFileChooser/git/tags{/sha}',
                'git_refs_url' => 'https://api.github.com/repos/iPaulPro/aFileChooser/git/refs{/sha}',
                'trees_url' => 'https://api.github.com/repos/iPaulPro/aFileChooser/git/trees{/sha}',
                'statuses_url' => 'https://api.github.com/repos/iPaulPro/aFileChooser/statuses/{sha}',
                'languages_url' => 'https://api.github.com/repos/iPaulPro/aFileChooser/languages',
                'stargazers_url' => 'https://api.github.com/repos/iPaulPro/aFileChooser/stargazers',
                'contributors_url' => 'https://api.github.com/repos/iPaulPro/aFileChooser/contributors',
                'subscribers_url' => 'https://api.github.com/repos/iPaulPro/aFileChooser/subscribers',
                'subscription_url' => 'https://api.github.com/repos/iPaulPro/aFileChooser/subscription',
                'commits_url' => 'https://api.github.com/repos/iPaulPro/aFileChooser/commits{/sha}',
                'git_commits_url' => 'https://api.github.com/repos/iPaulPro/aFileChooser/git/commits{/sha}',
                'comments_url' => 'https://api.github.com/repos/iPaulPro/aFileChooser/comments{/number}',
                'issue_comment_url' => 'https://api.github.com/repos/iPaulPro/aFileChooser/issues/comments{/number}',
                'contents_url' => 'https://api.github.com/repos/iPaulPro/aFileChooser/contents/{+path}',
                'compare_url' => 'https://api.github.com/repos/iPaulPro/aFileChooser/compare/{base}...{head}',
                'merges_url' => 'https://api.github.com/repos/iPaulPro/aFileChooser/merges',
                'archive_url' => 'https://api.github.com/repos/iPaulPro/aFileChooser/{archive_format}{/ref}',
                'downloads_url' => 'https://api.github.com/repos/iPaulPro/aFileChooser/downloads',
                'issues_url' => 'https://api.github.com/repos/iPaulPro/aFileChooser/issues{/number}',
                'pulls_url' => 'https://api.github.com/repos/iPaulPro/aFileChooser/pulls{/number}',
                'milestones_url' => 'https://api.github.com/repos/iPaulPro/aFileChooser/milestones{/number}',
                'notifications_url' => 'https://api.github.com/repos/iPaulPro/aFileChooser/notifications{?since,all,participating}',
                'labels_url' => 'https://api.github.com/repos/iPaulPro/aFileChooser/labels{/name}',
                'releases_url' => 'https://api.github.com/repos/iPaulPro/aFileChooser/releases{/id}',
                'deployments_url' => 'https://api.github.com/repos/iPaulPro/aFileChooser/deployments',
                'created_at' => '2011-12-16T13:56:07Z',
                'updated_at' => '2020-11-25T14:06:57Z',
                'pushed_at' => '2018-05-30T23:25:25Z',
                'git_url' => 'git://github.com/iPaulPro/aFileChooser.git',
                'ssh_url' => 'git@github.com:iPaulPro/aFileChooser.git',
                'clone_url' => 'https://github.com/iPaulPro/aFileChooser.git',
                'svn_url' => 'https://github.com/iPaulPro/aFileChooser',
                'homepage' => '',
                'size' => 5386,
                'stargazers_count' => 1767,
                'watchers_count' => 1767,
                'language' => 'Java',
                'has_issues' => true,
                'has_projects' => true,
                'has_downloads' => true,
                'has_wiki' => true,
                'has_pages' => false,
                'forks_count' => 874,
                'mirror_url' => null,
                'archived' => false,
                'disabled' => false,
                'open_issues_count' => 70,
                'license' => array(
                    'key' => 'other',
                    'name' => 'Other',
                    'spdx_id' => 'NOASSERTION',
                    'url' => null,
                    'node_id' => 'MDc6TGljZW5zZTA='
                ),
                'forks' => 874,
                'open_issues' => 70,
                'watchers' => 1767,
                'default_branch' => 'master',
                'score' => 1
            ),
        ];
    }
}