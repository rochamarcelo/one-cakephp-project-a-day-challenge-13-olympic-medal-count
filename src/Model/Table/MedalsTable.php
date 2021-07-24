<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Medals Model
 *
 * @property \App\Model\Table\SportsTable&\Cake\ORM\Association\BelongsTo $Sports
 * @property \App\Model\Table\CountriesTable&\Cake\ORM\Association\BelongsTo $Countries
 *
 * @method \App\Model\Entity\Medal newEmptyEntity()
 * @method \App\Model\Entity\Medal newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Medal[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Medal get($primaryKey, $options = [])
 * @method \App\Model\Entity\Medal findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Medal patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Medal[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Medal|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Medal saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Medal[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Medal[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Medal[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Medal[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class MedalsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('medals');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Sports', [
            'foreignKey' => 'sport_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id',
            'joinType' => 'INNER',
        ]);

        $this->addBehavior('CounterCache', [
            'Countries' => [
                'response_count'
            ],
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('event_name')
            ->maxLength('event_name', 255)
            ->requirePresence('event_name', 'create')
            ->notEmptyString('event_name');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['sport_id'], 'Sports'), ['errorField' => 'sport_id']);
        $rules->add($rules->existsIn(['country_id'], 'Countries'), ['errorField' => 'country_id']);

        return $rules;
    }
}
